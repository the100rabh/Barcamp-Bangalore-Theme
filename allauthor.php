<?php get_header(); ?>

<div id="content">

	<div id="contentleft">

       	<?php if (function_exists('wp_all_authors')) { ?><?php wp_all_authors('show_fullname=1&optioncount=0&hide_empty=0&exclude_admin=1'); ?><?php } ?>
	
	</div>
	
<?php include(TEMPLATEPATH."/l_author_sidebar.php");?>

<?php include(TEMPLATEPATH."/r_sidebar.php");?>

</div>

<!-- The main column ends  -->

<?php get_footer(); ?>
