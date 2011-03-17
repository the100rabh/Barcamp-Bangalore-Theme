<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="distribution" content="global" />
<meta name="robots" content="follow, all" />
<meta name="language" content="en, sv" />

<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<!-- leave this for stats please -->




<link rel="Shortcut Icon" href="<?php echo get_settings('home'); ?>/bcb/wp-content/themes/barcampbangalore/images/favicon.ico" type="image/x-icon" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="Comments Feed" href="<?php bloginfo('comments_rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>
<style type="text/css" media="screen">
<!-- @import url( <?php bloginfo('stylesheet_url'); ?> ); -->
</style>
</head>

<body><div id="header">

	<div class="headerleft">
<a href="<?php echo get_settings('home'); ?>/"><img src="http://barcampbangalore.org/bcb/wp-content/themes/barcampbangalore/images/path5086.png" border = 0 /></a> 

		<?php /* ?><a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a><br />
		<b><?php bloginfo('description'); ?></b> <?php */ ?>
	</div>
	
	<div class="headerright">
	<?php print_login_links();?>
		<ul>
			<li><a href="<?php echo get_settings('home'); ?>">Home</a></li>
			<li><a href="<?php echo get_settings('home')."/event/"; ?>">Sessions</a></li>
			<li><a href="<?php echo get_settings('home')."/event/author"; ?>">People</a></li>
			<?php wp_list_pages('title_li=&depth=1&include='.$NAV_ARRAY); ?>
			
		</ul>
	</div>

</div>
