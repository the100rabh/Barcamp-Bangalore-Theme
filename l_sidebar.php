<!-- begin l_sidebar -->

<div id="l_sidebar">
	<ul id="l_sidebarwidgeted">
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
	
	<li id="Recent">
	<h2>Recently Added</h2>
		<ul>
			<?php get_archives('postbypost', 10); ?>
		</ul>
	</li>
	<?php endif; ?>

	<li id="BCB9Pipe"><br/><h2 class="widgettitle">BCB9 Snippets from the Web</h2>
        
	<?php theme_bcbYPipe("BCB9"); ?>
        </li>
	</ul>
	
</div>

<!-- end l_sidebar -->