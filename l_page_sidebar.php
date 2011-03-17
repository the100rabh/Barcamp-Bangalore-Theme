<!-- begin l_page_sidebar -->



<div id="l_sidebar">







<?php show_attending_button($post); ?>



<?php theme_bcbYPipe("BCB9-S".$post->ID); ?>





<ul id="l_sidebarwidgeted">

	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>



<?php endif; ?>













	</ul>



</div>



<!-- end l_page_sidebar -->