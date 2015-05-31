<?php

// theme setup
if (!function_exists('franklin_setup')):
	function franklin_setup() {	
		register_nav_menus( array(
			'primary' => __('Primary Menu', 'franklin'),	
			'secondary' => __('Secondary Menu', 'franklin'),
			'footer' => __('Footer Menu', 'franklin')	
		));
		add_theme_support('post-thumbnails');
		add_theme_support('automatic-feed-links');
		add_theme_support('post-formats', array('aside','quote'));
		add_image_size('featured', 750);
		add_image_size('aside', 300);
		add_editor_style( get_template_directory_uri() . '/assets/css/editor-style.css' );
		// set content width  
		if (!isset($content_width)) {$content_width = 750;}	
	}
endif; 
add_action('after_setup_theme', 'franklin_setup');

// load css 
function franklin_css() {	
	//wp_enqueue_style('franklin_source_sans', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,900');
	//wp_enqueue_style('franklin_open_sans', '//fonts.googleapis.com/css?family=Open+Sans:400,600');
	wp_enqueue_style('franklin_bootstrap_css', get_template_directory_uri() . '/assets/css/bootstrap.min.css');	   
	wp_enqueue_style('franklin_style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'franklin_css');

// load javascript
function franklin_javascript() {	
	wp_enqueue_script('franklin_bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.1.1', true); 	
	wp_enqueue_script('franklin_script', get_template_directory_uri() . '/assets/js/franklin.js', array('jquery'), '1.0', true);
	if (is_singular() && comments_open()) {wp_enqueue_script('comment-reply');}
}
add_action('wp_enqueue_scripts', 'franklin_javascript');

// html5 shiv
function franklin_html5_shiv() {
    echo '<!--[if lt IE 9]>';
    echo '<script src="'. get_template_directory_uri() .'/assets/js/html5shiv.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'franklin_html5_shiv');

// sidebar
function franklin_widgets_init() {
	register_sidebar(array(
		'name' => __('Primary Sidebar', 'franklin'),
		'id' => 'primary-sidebar',
		'description' => __('Widgets in this area will appear in the right sidebar on all pages and posts.', 'franklin'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><hr>',
		'after_widget' => "</aside>",
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));	
	register_sidebar(array(
		'name' => __('Footer Left', 'franklin'),
		'id' => 'footer-left-sidebar',
		'description' => __('Widgets in this area will appear in the left column of the footer.', 'franklin'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));	
	register_sidebar(array(
		'name' => __('Footer Middle', 'franklin'),
		'id' => 'footer-middle-sidebar',
		'description' => __('Widgets in this area will appear in the middle column of the footer.', 'franklin'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));	
	register_sidebar(array(
		'name' => __('Footer Right', 'franklin'),
		'id' => 'footer-right-sidebar',
		'description' => __('Widgets in this area will appear in the right column of the footer.', 'franklin'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));	
}
add_action('widgets_init', 'franklin_widgets_init');

// page titles
function franklin_title($title, $sep) {
	global $paged, $page;
	if (is_feed()) { return $title; }
	$title .= get_bloginfo('name');	
	$site_description = get_bloginfo('description', 'display');
	if ( $site_description && (is_home() || is_front_page())) {	$title = "$title $sep $site_description"; }	
	if ( $paged >= 2 || $page >= 2 ) { $title = "$title $sep " . sprintf( __('Page %s', 'franklin'), max($paged, $page)); }
	return $title;
}
add_filter('wp_title', 'franklin_title', 10, 2);

// pagination
if (!function_exists('franklin_pagination')):
	function franklin_pagination() {
		global $wp_query;
		$big = 999999999;	
		echo '<div class="page-links">';	
		echo paginate_links( array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $wp_query->max_num_pages,
			'prev_next' => False,
		));
		echo '</div>';
	}
endif;

// comments
if (!function_exists('franklin_comment')) :
	function franklin_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		?>	
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"> 	
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-header">	
				<div class="comment-author">						
					<?php echo get_avatar($comment, 40); ?> 
					<p class="comment-author-name"><?php comment_author(); ?><br /><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date() . ' - ' . get_comment_time() ?></a></p>
				</div>				
			</div>
			<div class="comment-body">			
				<?php comment_text(); ?>
				<?php if ('0' == $comment->comment_approved) : ?>				
					<p class="comment-awaiting-moderation"><?php _e('Comment is awaiting moderation!', 'franklin'); ?></p>					
				<?php endif; ?>				
			</div>			
		</div>
	<?php 
	}
endif;

// theme customizer
function franklin_customize_register($wp_customize) {
	// logo upload
	$wp_customize->add_section('franklin_logo_section', array(
		'title' => __('Upload Logo', 'franklin'),
		'priority' => 900		
	));
	$wp_customize->add_setting('franklin_logo_setting', array(
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
		'label' => __('Logo', 'franklin'),
		'section' => 'franklin_logo_section',
		'settings' => 'franklin_logo_setting'
	)));	
    // color scheme
	$wp_customize->add_section('franklin_color_section', array(
		'title' => __('Color Scheme', 'franklin'),
		'priority' => 901
	));
	$wp_customize->add_setting('franklin_color_setting', array(
	    'default' => '#20b2aa',
	    'sanitize_callback' => 'sanitize_hex_color'	    
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color', array(        
        'section' => 'franklin_color_section',
        'settings' => 'franklin_color_setting'
    )));    
}
add_action('customize_register', 'franklin_customize_register');

function franklin_custom_css() {
	wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/custom.css');
    $color = get_theme_mod('franklin_color_setting');
    $custom_css = "header, .widget_tag_cloud a:hover, .sticky-img, #primary-menu li ul li {background-color: {$color};} a:hover, #primary-menu li:hover a {color: {$color};}";
    wp_add_inline_style('custom-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'franklin_custom_css');

?>