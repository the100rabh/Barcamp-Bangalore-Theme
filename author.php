<?php 
//header("Location: ".get_settings('home')."/wp-allauthors.php");
//if(isset($_GET['author_name'])){$curauth = get_userdatabylogin($author_name);
if(isset($_GET['author_name'])){$curauth = get_userdatabylogin($_GET['author_name']);
}else {
$curauth = get_userdata(intval($author));

}
get_header();
//echo $curauth->ID;
?>

<div id="content">

	<div id="contentleft">



<!---------------------- This sets the $curauth variable ------------------------
-->
<?php

dprint_r($curauth);

?>
<TABLE>
<TR>
	<TD><?php echo get_avatar( $curauth->user_email, '80' ); ?></TD>
	<TD valign="top"><h1 style="color:#000; padding:0px;margin:0px"><?php echo $curauth->user_firstname;?> <?php echo $curauth->user_lastname;?> </h1>(<a href="<?php echo $curauth->user_url;?>"><?php echo $curauth->display_name;?></a>)
	<?php echo $curauth->user_description; ?> <br>Added <strong><?php echo author__post_count($curauth->ID);?></strong> sessions so far.
	
	</TD>
</TR>
</TABLE>
<br />
<!-------------------------------author ends------------------------------------- 
-->

<?php

if($curauth->user_login != 'mixdevWWWWWWW'){ //nothing man nothing =D leave it
	$postsatt =  $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta WHERE  meta_key = 'user_attending' AND meta_value = '$curauth->user_login'");

	if(isset($postsatt)){


	echo "<h1 style=\"color:#999\">$curauth->display_name is Attending ".count($postsatt)." sessions:</h1>";


		//$qarr = implode(", ",$postatt);

		//$postZatt = $wpdb->get_results("SELECT * from $wpdb->posts W
//print_r($postsatt);
		foreach($postsatt as $attpost)
		{
			
			$my_id = $attpost->post_id;
			$ph = get_post($my_id); 
						$post_permalink = get_permalink( $my_id );
			
			
			
		
			echo "<h2 class=\"postinfoh2\">",++$dumpooooooooo,")  <a href=\"$post_permalink\" rel=\"bookmark\">$ph->post_title</a></h2>";
			//echo "<h2 class=\"postinfoh2\">",++$dumpooooooooo,")  <a href=\"http://barcampbangalore.org/bcb8/$ph->post_name\" rel=\"bookmark\">$ph->post_title</a></h2>";

			

		//	echo "<div class=\"postinfoarchive\">			<img   src=\"http://www.gravatar.com/avatar/4defdd90c9fc636fbaa76493962438e7?s=16&amp;d=wavatar&amp;r=G\" class='avatar avatar-16' height='16' width='16' /> <a href=\"http://barcampbangalore.org/author/kakashi_\">kakashi_</a> | <a href=\"http://barcampbangalore.org/bcb8/machine-translation-of-indian-languages-and-challenges#respond\" title=\"Comment on Machine Translation of Indian Languages and Challenges\">Leave a Comment</a> | Filed Under <a href=\"http://barcampbangalore.org/event/bcb8\" title=\"View all posts in BCB8\" rel=\"category tag\">BCB8</a>,  <a href=\"http://barcampbangalore.org/event/bcb8/themed\" title=\"View all posts in theme session\" rel=\"category tag\">theme session</a> 		</div><div style=\"clear:both\"></div>";

		}//foreach


		echo "<div style=\"clear:both\"></div><p>";

	}

}




//if(!$curauth->ID)
{

			echo "<h1 style=\"color:#999\">$curauth->display_name is Presenting the following sessions: </h1>";

		 if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php //the_content(__('Read more'));?><div style="clear:both;"></div>
		<div class="postinfo">
			Filed Under <?php the_category(', ') ?> | <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>&nbsp;<?php edit_post_link('(Edit)', '', ''); ?>
		</div>
	 	
		<!--
		<?php trackback_rdf(); ?>
		-->
		
		<?php endwhile; else: ?>
			
		<p><?php _e(''); ?></p><?php endif; ?>
		<?php posts_nav_link(' &#8212; ', __('&laquo; go back'), __('keep looking &raquo;')); ?>
		
		<!--
		<p><?php //posts_nav_link(' &#8212; ', __('&larr; Previous Page'), __('Next Page &rarr;')); ?></p>
		-->
	
	</div>


<?php
}
//else
{
?>

<?php
}	
	
?>

	
<?php include(TEMPLATEPATH."/l_author_sidebar.php");?>

<?php include(TEMPLATEPATH."/r_sidebar.php");?>

</div>

<!-- The main column ends  -->

<?php get_footer(); ?>