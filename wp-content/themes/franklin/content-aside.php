<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<?php if (has_post_thumbnail()) { ?>
			<div class="col-md-4">
				<?php the_post_thumbnail('aside'); ?>
			</div>	
			<div class="col-md-8">
		<?php } else { ?>
			<div class="col-lg-12">
		<?php } ?>	
			<?php
				if (is_single()) :
					the_title('<h1 id="post-title">', '</h1>');					
				else :
					the_title('<h3 class="post-title"><a href="' . esc_url( get_permalink()) . '" rel="bookmark">', '</a></h3>');			    	   
				endif;		
		    ?>	
			<?php the_content(); ?>	
		</div>
	</div>	
</article>
<hr class="post-divider">