<?php
	/*	
	*	CrunchPress Options File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the CrunchPress panel elements and create the 
	*	CrunchPress panel at the back-end of the framework
	*	---------------------------------------------------------------------
	*/
	
	add_action('wp_ajax_sidebar_settings','videogo_sidebar_settings');
	function videogo_sidebar_settings(){
	
		foreach ($_REQUEST as $keys=>$values) {
			$$keys = trim($values);
		}			
	?>
	<div class="cp-wrapper bootstrap_admin cp-margin-left"> 
		<div class="hbg top_navigation row-fluid">
			<div class="cp-logo span2">
				<img src="<?php echo esc_url(VIDEOGO_PATH_URL.'/framework/images/logo.png');?>" class="logo" />
			</div>
			<div class="sidebar span10">
				<?php echo videogo_top_navigation_html_tooltip();?>
			</div>
		</div>
		<div class="content-area-main row-fluid"> 
			<div class="sidebar-wraper span2">
				<div class="sidebar-sublinks">
					<ul id="wp_t_o_right_menu">
						<li id="active_tab" class="sidebar_settings"><?php esc_html_e('Add New Sidebar', 'videogo'); ?></li>
					</ul>
				</div>
			</div>
			<div class="content-area span10">
				<form id="options-panel-form" name="cp-panel-form">
					<div class="panel-elements" id="panel-elements">
					<div class="panel-element" id="panel-element-save-complete">
						<div class="panel-element-save-text">
							<?php esc_attr_e('Save Options Complete', 'videogo'); ?>
						</div>
					  <div class="panel-element-save-arrow"></div>
					</div>
					<div class="panel-element">
						<?php
							$videogo_return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');		
							if(isset($action) AND $action == 'sidebar_settings'){
								$videogo_sidebar_xml = '<sidebar_settings>';
								if(isset($_POST['sidebar'])){
									$videogo_sidebars = $_POST['sidebar'];
									foreach($videogo_sidebars as $keys=>$values){
										$videogo_sidebar_xml = $videogo_sidebar_xml . videogo_create_xml_tag('sidebar_name',$values);
									}
								}
								$videogo_sidebar_xml = $videogo_sidebar_xml . '</sidebar_settings>';
								if(!videogo_save_option('sidebar_settings', get_option('sidebar_settings'), $videogo_sidebar_xml)){
								
									die( json_encode($videogo_return_data) );
									
								}
								
								die( json_encode( array('success'=>'0') ) );
								
							}
							
							/* Sidebar values getting from database */
							$videogo_sidebar_settings = get_option('sidebar_settings');
						?>
					</div>
					<ul class="sidebar_settings">
						<li class="active_tab" id="sidebar_settings">
							<div class="row-fluid">
								<div class="panel-input span8">
									<div class="panel-title">
										<h3> <?php esc_html_e('Add Sidebar Name', 'videogo'); ?> </h3>
									</div>
									<input type="text" id="add-more-sidebar" value="type title here" rel="type title here">
									<div id="add-more-sidebar" class="add-more-sidebar"></div>
								</div>
								<div class="span4 right-box-sec"><p><?php esc_html_e('Add New Sidebars(Widget Areas) here you can manage them from Dashboard > Appearance > Widgets.','videogo');?></p></div>
								<div id="selected-sidebar" class="selected-sidebar first span12">
									<div class="default-sidebar-item" id="sidebar-item">
										<div class="panel-delete-sidebar"></div>
										<div class="slider-item-text"></div>
										<input type="hidden" id="sidebar">
									</div>
								<?php
								//Sidebar addition
								if($videogo_sidebar_settings <> ''){
									$videogo_sidebars_xml = new DOMDocument();
									$videogo_sidebars_xml->loadXML($videogo_sidebar_settings);
									foreach( $videogo_sidebars_xml->documentElement->childNodes as $videogo_sidebar_name ){?>
									<div class="sidebar-item" id="sidebar-item">
										<div class="panel-delete-sidebar"></div>
										<div class="slider-item-text"><?php echo html_entity_decode($videogo_sidebar_name->nodeValue); ?></div>
										<input type="hidden" name="sidebar[]" id="sidebar" value="<?php echo html_entity_decode($videogo_sidebar_name->nodeValue); ?>">
									</div>
								<?php }
								}
								?>
								</div>
							</div>
						</li>
					</ul>
					<div class="clear"></div>
					<div class="panel-element-tail">
					  <div class="tail-save-changes">
						<div class="loading-save-changes"></div>
						<input type="submit" value="<?php echo esc_attr__('Save Changes','videogo') ?>">
						<input type="hidden" name="action" value="sidebar_settings">
					  </div>
					</div>
				</div>
			</form>
		</div>
      <!--content End --> 
    </div>
    <!--content area end --> 
  </div>
	<?php
}	
?>
