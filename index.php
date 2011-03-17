<?php get_header(); ?>
<div id="content">

	<div id="contentleft">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h1><?php the_title(); ?></h1>

		<?php the_content(__('Read more'));?><div style="clear:both;"></div>
<?php //dprint_r($post); ?>

<div class="postinfo_detail">  <span class="postinfo_au">

<?php echo get_avatar( get_the_author_email(), '16' ); ?> <?php echo t_authlink(get_nicename($post->post_author)); ?></span>

<div align="right"><strong><?php edit_post_link('(Edit)', '', ''); ?></strong></div>

<span class="postinfo_tags">Tagged as <?php

$posttags = get_the_tags();

if ($posttags) {$sepp="";

foreach($posttags as $tag) {

echo $sepp."<a href=\"".get_settings('home')."/event/tag/".$tag->name."\">".$tag->name."</a>";$sepp=", ";

}

}

?></span>
		</div>

<?php //echo "<h3>Presentations</h3>"; echo get_post_meta($post->ID, "tags", true); ?>

		<?php //echo "<h3>Presentations</h3>"; 
		echo get_post_meta($post->ID, "session_embed", true); ?>

		<!--<?php trackback_rdf(); ?>-->

		<strong><?php //comments_number();?>  </strong>

		<?php comments_template(); // Get wp-comments.php template ?>

		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>

		<p align="center"><?php posts_nav_link(' &#8212; &#8212; ', __('&larr; Previous Page'), __('Next Page &rarr;')); ?></p>

	</div>
<?php include(TEMPLATEPATH."/l_page_sidebar.php");?>
<?php include(TEMPLATEPATH."/r_sidebar.php");?>
</div>
<!-- The main column ends  -->
<?php get_footer(); ?>