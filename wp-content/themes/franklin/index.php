<?php get_header(); ?>
<div class="row" role="main" >
	<div class="col-md-8">
		<?php
			if (have_posts()) :				
				while (have_posts()) : the_post();					
					get_template_part('content', get_post_format());
				endwhile;
			else :
				get_template_part('content', 'none');
			endif;
		?>
		<?php franklin_pagination(); ?>
	</div>
	<?php get_sidebar('primary-sidebar'); ?>
</div>
<?php get_footer(); ?>				