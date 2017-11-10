<!-- Search Widget -->
<div class="cp-sidebar-box">
	<form method="get" id="searchform_widget" action="<?php  echo esc_url(home_url('/')); ?>">
		
		<input type="text" required="" placeholder="<?php esc_html_e('Type your text here','videogo');?>" name="s" value="<?php the_search_query();?>"/>
		<button><i class="fa fa-search"></i></button>
	</form>
</div>