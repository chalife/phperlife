<?php get_header(); ?>
<div class="row" role="main" >
	<div class="col-md-8">
		<p id="breadcrumbs"><span class="glyphicon glyphicon-home"></span> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Home</a> <span class="glyphicon glyphicon-chevron-right"></span> <?php the_category('<span class="slash"> / </span>'); ?> <span class="glyphicon glyphicon-chevron-right"></span> <?php the_title() ?></p>
		<?php				
			while (have_posts()) : the_post();					
				get_template_part('content', get_post_format());
				if (comments_open()) {
					comments_template();
				}					
			endwhile;
		?>		
	</div>
	<?php get_sidebar('primary-sidebar'); ?>
</div>
<?php get_footer(); ?>				