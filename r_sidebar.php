<!-- begin r_sidebar -->



<div id="r_sidebar">



	<ul id="r_sidebarwidgeted">









<form id="searchform" method="get" action="http://barcampbangalore.org/"><div>



			<label for="s" class="hidden">Search for:</label>

			<input type="text" name="s" id="s" size="10" value="" />

			<input type="submit" value="Search Sessions" align="right" />

		</div></form>



































	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>

	

	<li id="Search">

	<form method="get" id="search_form" action="<?php bloginfo('home'); ?>/">

	<input type="text" class="search_input" value="To search, type and hit enter" name="s" id="s" onfocus="if (this.value == 'To search, type and hit enter') {this.value = '';}" onblur="if (this.value == '') {this.value = 'To search, type and hit enter';}" />

	<input type="hidden" id="searchsubmit" value="Search" /></form><br />

	</li>



	<li id="About">

	<h2>About Barcamp</h2>

		<p>Barcamp is a tech unconference.</p>

	</li>

	

	<li id="Blogroll">

	<h2>Websites</h2>

		<ul>

			<?php get_links(-1, '<li>', '</li>', ' - '); ?>

		</ul>

	</li>

        

	<?php endif; ?>

	</ul>

			

</div>



<!-- end r_sidebar -->