<?php get_header(); ?>
<div id="content">
	<div id="contentleft">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h2 class="postinfoh2"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php //the_content(__('Read more'));?><!-- rstyle="clear:both;" /r-->

		<div class="postinfoarchive">
			<?php echo get_avatar( get_the_author_email(), '16' ); ?> <?php echo t_authlink(get_nicename($post->post_author)); ?> | <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?> | Filed Under <?php the_category(', ') ?> <?php edit_post_link('(Edit)', '', ''); ?> 

		</div><div style="clear:both"></div>

		<!--
		<?php trackback_rdf(); ?>
		-->
		<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
		
		<p><?php posts_nav_link(' &#8212; ', __('&larr; Previous Page'), __('Next Page &rarr;')); ?></p>
	</div>

<?php include(TEMPLATEPATH."/l_sidebar.php");?>
<?php include(TEMPLATEPATH."/r_sidebar.php");?>
</div>

<!-- The main column ends  -->
<?php get_footer(); ?>