<?php get_header(); ?>

<div id="content">

	<div id="contentleft">



<!---------------------- This sets the $curauth variable ------------------------
-->
<?php
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name);
else :
$curauth = get_userdata(intval($author));
endif;
dprint_r($curauth);




?>
<TABLE>
<TR>
	<TD><?php echo get_avatar( $curauth->user_email, '80' ); ?></TD>
	<TD valign="top"><h1 style="color:#000; padding:0px;margin:0px"><?php echo $curauth->user_firstname;?> <?php echo $curauth->user_lastname;?> (<a href="<?php echo $curauth->user_url;?>"><?php echo $curauth->user_nicename;?></a>)</h1>
	<?php echo $curauth->user_description; ?> <br>Added <strong><?php echo author__post_count($curauth->ID);?></strong> sessions so far.
	
	</TD>
</TR>
</TABLE>
<br />
<!-------------------------------author ends------------------------------------- 
-->




		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php //the_content(__('Read more'));?><div style="clear:both;"></div>
		<div class="postinfo">
			<?php the_time('F j, Y'); ?> | Filed Under <?php the_category(', ') ?> | <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>&nbsp;<?php edit_post_link('(Edit)', '', ''); ?>
		</div>
	 	
		<!--
		<?php trackback_rdf(); ?>
		-->
		
		<?php endwhile; else: ?>
			
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
		<p><?php posts_nav_link(' &#8212; ', __('&larr; Previous Page'), __('Next Page &rarr;')); ?></p>
	
	</div>
	
<?php include(TEMPLATEPATH."/l_author_sidebar.php");?>

<?php include(TEMPLATEPATH."/r_sidebar.php");?>

</div>

<!-- The main column ends  -->

<?php get_footer(); ?>