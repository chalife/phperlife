<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (is_sticky()) : ?>	
		<div class="sticky-txt <?php if (has_post_thumbnail()) { echo 'sticky-img'; } ?>"><span class="glyphicon glyphicon-star"></span> <?php _e('Featured Post', 'franklin'); ?></div>
	<?php endif; ?>
	<?php the_post_thumbnail('featured'); ?>		
	<?php
		if (is_single()) :
			the_title('<h1 id="post-title">', '</h1>');
			the_content();
		else :
			the_title('<h3 class="post-title"><a href="' . esc_url( get_permalink()) . '" rel="bookmark">', '</a></h3>');
			if ($post->post_excerpt) :
	        	the_excerpt();
	        	echo '<a class="excerpt-link" href="'. esc_url( get_permalink()) .'">Continue Reading <span>&rarr;</span> </a>';
	    	else :	
	    		the_content('Continue Reading <span>&rarr;</span>');	
	    	endif;	    
		endif;		
    ?>	
	<?php wp_link_pages(); ?>
	<div class="post-meta clearfix <?php if (!is_single()) { echo 'post-meta-list'; } ?>">
		<p class="author-date">
			<span class="glyphicon glyphicon-user"></span> <?php the_author_meta('display_name'); ?> 
			<span class="glyphicon glyphicon-calendar"></span> <?php the_time(get_option('date_format')); ?>		
		</p>
		<?php 
			$post_tags = get_the_tags();
			if ($post_tags) :
				echo '<p class="post-tags"><span class="glyphicon glyphicon-tags"></span>';
			    foreach($post_tags as $tag) {
			    	echo '<a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name.'</a> <span class="slash"> / </span>'; 
			  	}
			  	echo '</p>';					  	
			endif;
		?>	
		<?php if (is_single()) : ?>
			<?php if (get_the_author_meta('description')): ?>					
				<div id="author-desc">
					<?php echo get_avatar(get_the_author_meta('ID'), 100); ?>
					<h5>About <?php the_author_meta('display_name'); ?></h5>	
					<p><?php the_author_meta('description'); ?></p>	
				</div>	
			<?php endif; ?>		
		<?php endif; ?>	
	</div>	
	<?php if (is_single()) : ?>	
		<div id="post-nav" class="clearfix">				
			<?php
				$prev_post = get_previous_post();
				if (!empty($prev_post)): ?>			
				<div id="post-nav-prev">
					<span class="glyphicon glyphicon-chevron-left"></span> 
					<a class="post-nav-older" href="<?php echo get_permalink($prev_post->ID); ?>">
						<?php echo get_the_title($prev_post); ?>
					</a>
				</div>
			<?php endif; ?>			
			<?php
				$next_post = get_next_post();
				if (!empty($next_post)): ?>
				<div id="post-nav-next">
					<a href="<?php echo get_permalink($next_post->ID); ?>">										
						<?php echo get_the_title($next_post); ?>				
					</a>
					<span class="glyphicon glyphicon-chevron-right"></span>
				</div>
			<?php endif; ?>
		</div>	
	<?php endif; ?>	
</article>
<hr class="post-divider">