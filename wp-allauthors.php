<?php
/**
 * Used to be the page which displayed the registration form.
 *
 * This file is no longer used in WordPress and is
 * deprecated.
 *
 * @package WordPress
 * @deprecated Use wp_register() to create a registration link instead
 */

require('./wp-load.php');


 get_header(); ?>

<style>
#authorlist li{ padding:10px;border:1px solid #ccc;}
</style>

<div id="content">

	<div id="contentleft">
		<div id="authorlist">
       	<?php if (function_exists('wp_all_authors')) { ?><?php wp_all_authors('show_fullname=1&optioncount=0&hide_empty=0&exclude_admin=1'); ?><?php } ?>
		</div>
	</div>
	
<?php include(TEMPLATEPATH."/l_author_sidebar.php");?>

<?php include(TEMPLATEPATH."/r_sidebar.php");?>

</div>

<!-- The main column ends  -->

<?php get_footer(); ?>