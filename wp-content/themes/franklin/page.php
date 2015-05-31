<?php get_header(); ?>
<div class="row" role="main" >
	<div class="col-lg-8">
		<?php				
			while (have_posts()) : the_post();					
				get_template_part( 'content', 'page' );
				if (comments_open()) {
					comments_template();
				}					
			endwhile;
		?>		
	</div>
	<?php get_sidebar('primary-sidebar'); ?>
</div>
<?php get_footer(); ?>				