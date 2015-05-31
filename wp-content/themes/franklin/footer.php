</div>
<footer>
	<?php if (is_active_sidebar('footer-left-sidebar') || is_active_sidebar('footer-middle-sidebar') || is_active_sidebar('footer-right-sidebar')) : ?>
		<div id="footer-top" class="container">
			<div class="row">
				<div class="col-md-4">
					<?php dynamic_sidebar('footer-left-sidebar'); ?>
				</div>
				<div class="col-md-4">
					<?php dynamic_sidebar('footer-middle-sidebar'); ?>
				</div>
				<div class="col-md-4">
					<?php dynamic_sidebar('footer-right-sidebar'); ?>
				</div>
			</div>	
		</div>
	<?php endif; ?>	
	<div id="footer-bottom">
		<div class="container">
			<div class="row">
				<div id="footer-meta" class="col-md-9">
					<p>&copy; <a id="footer-site" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></p>
					<?php wp_nav_menu(array('theme_location' => 'footer','container' => 'false','depth' => 1,'fallback_cb' => 'false')); ?>
				</div>
				<div id="footer-credit" class="col-md-3">
					<p><a href="http://www.wpmultiverse.com/themes/franklin/" title="Franklin WordPress Theme">Franklin Theme</a></p>
				</div>
			</div>
		</div>        <div style="margin: 0px auto;text-align:center;">			<a href="http://www.miitbeian.gov.cn/" rel="external nofollow" target="_blank">                <?php echo get_option( 'zh_cn_l10n_icp_num' );?>            </a>		</div>
	</div>
</footer>
<?php wp_footer(); ?>   
</body>
</html>