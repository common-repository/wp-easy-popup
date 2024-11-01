<?php
/*
Plugin Name: WP Easy Popup
* Plugin URI: https://www.startbitsolutions.com
* Description: The WP Easy Popup is completely free and totally open source, and there is literally no better way to make your website look totally stunning..
* Version: 1.1
* Author: Team Startbit
* Author URI: https://www.startbitsolutions.com/

	Copyright 2014  Startbit IT Solutions Pvt. Ltd.  (email : support@startbitsolutions.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

	 You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action('wp', 'viva_wepu_process_popup');
function viva_wepu_process_popup()
{
	$type = 'spopup';
	$args=array(
  'post_type' => $type,
  'post_status' => 'publish'
  );
	$my_query = null;
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) 
	{
  				while ($my_query->have_posts()) : $my_query->the_post();
				    $postid=get_the_ID();
				    $pages = get_post_meta($postid,'page_type', true);	
				    $popup_timeout = get_post_meta($postid, 'popup_timeout', true);
				    $popup_close = get_post_meta($postid, 'popup_close', true);
					 $bg_color = get_post_meta($postid, 'background_color', true);
					 $header_background_color = get_post_meta($postid, 'header_background_color', true);
					 $header_text = get_post_meta($postid, 'header_text', true);
					 $header_font_size = get_post_meta($postid, 'header_font_size', true);
					 $header_color = get_post_meta($postid, 'header_color', true);
					 $image = get_post_meta($postid, 'image', true);
					 $color = get_post_meta($postid, 'color', true);
					 $close_color = get_post_meta($postid, 'close_color', true);
					 $close_color_1 = get_post_meta($postid, 'close_color_1', true);
					 $red_round = get_post_meta($postid, 'red_round', true);
					 $content = get_the_content();
					 $start_date = get_post_meta($postid, 'start_date', true);
					 $start_date = strtotime($start_date);
					 $end_date = get_post_meta($postid, 'end_date', true);
					 $end_date = strtotime($end_date);
					 $date =date("m/d/Y");
					 $date =strtotime($date);
					 $logged_in = get_post_meta($postid, 'logged_in', true);
					 $mobile_device = get_post_meta($postid, 'mobile_device', true);
					 $login_users= get_post_meta($postid, 'loginuser', true);
					 $whoshow= get_post_meta($postid, 'whoshow', true);
					 $bool = is_user_logged_in();
					 $display_status = get_post_meta($postid, 'display_status', true);	
					 $mob=wp_is_mobile();
					 $userids = get_current_user_id();
					 $user_info = get_userdata($userids);
					 $userroles=  $user_info->roles;
					 $userrole = $userroles[0];
					if($whoshow == '' && isset($whoshow )){$whoshow ='administrator';}
			   	 $Popupwfb = "";	
			   	 $imgposs = get_post_meta($postid,'img_position',true);
			   	 if($imgposs == '' || $imgposs == 'left'){   
			   	  $imgposs ='left';
			   	 }
			   	 if($imgposs == 'full'){
			   	  $imgposs ='full';
			   	 }
			   	 if($imgposs == 'none' || $imgposs == 'center' || $imgposs == 'full' ){
			   	   $margin= '0px auto';
			   	   $textwidth = "100%";
			   	 }else {
			   	 	$margin= '5px';
			   	 	 $textwidth = "50%";
			   	 	}
				if( $popup_close == "") 
				{	
					$Popupwfb = $Popupwfb.'<script language="javascript" type="text/javascript">';		
					$Popupwfb = $Popupwfb.'function PopupWithFancybox() { 
													jQuery.fancybox(addText);
												}';
					$Popupwfb = $Popupwfb."setTimeout('PopupWithFancybox()',".$popup_timeout.");";
					$Popupwfb = $Popupwfb.'</script>';
             }
				else {
					$Popupwfb = $Popupwfb.'<script language="javascript" type="text/javascript">';
					$Popupwfb = $Popupwfb.'function PopupWithFancybox() { 
												jQuery.fancybox(addText);
												}';
					 $Popupwfb = $Popupwfb."setTimeout('PopupWithFancybox()',".$popup_timeout.");";
					 $Popupwfb = $Popupwfb."setTimeout('parent.jQuery.fancybox.close()',".$popup_close.");";
				   $Popupwfb = $Popupwfb.'</script>';
              }		
			if(empty($image)) 
			
			{
				   $Popupwfb = $Popupwfb.'<div id="simple-popup-with-fancybox" class="fancybox-wrap"  style="display:none;">';
				   $Popupwfb = $Popupwfb.'<div id="easy12" class="fancybox-content-inside"  style="color:'.$header_color.';background:'.$header_background_color.';text-align:center;padding-top: 10px;">';
				   $Popupwfb = $Popupwfb.'<div id="rrcross" onclick="closefancy()" class="close" style="opacity: 1;margin-right: -10px;font-size: 12px;margin-top: -20px;color:'.$close_color_1.';background-color:'.$close_color.';width: 20px;padding: 4px;border-radius: 5px;float:right;cursor: pointer;">';
               $Popupwfb = $Popupwfb.'X';
               $Popupwfb = $Popupwfb.'</div>';					   
				   $Popupwfb = $Popupwfb.'<p style="margin:0 !important;font-size:'.$header_font_size.'px !important;">'.$header_text.'</p>';
			      $Popupwfb = $Popupwfb.'</div>';
		         $Popupwfb = $Popupwfb.'<div id="easy" class="fancybox-content-inside"  style="width:100%;background:'.$bg_color.';color:'.$color.';padding:15px;">';
				   $Popupwfb = $Popupwfb.'<p style="margin:5px;margin: 5px;padding: 10px;">'.$content.'</p>';			      
			      $Popupwfb = $Popupwfb.'</div>';
		         $Popupwfb = $Popupwfb.'</div>';
			}
			else 
			{
				  
					$Popupwfb = $Popupwfb.'<div id="simple-popup-with-fancybox" class="fancybox-wrap"  style="display:none;">';
					$Popupwfb = $Popupwfb.'<div id="easy12" class="fancybox-content-inside"  style="color:'.$header_color.';background:'.$header_background_color.';text-align:center;padding-top: 10px;">';
					$Popupwfb = $Popupwfb.'<div id="rrcross" onclick="closefancy()" class="close" style="opacity: 1;margin-right: -10px;font-size: 12px;margin-top: -20px;color:'.$close_color_1.';background-color:'.$close_color.';width: 20px;padding: 4px;border-radius: 5px;float:right;cursor: pointer;">';
	            $Popupwfb = $Popupwfb.'X';
	            $Popupwfb = $Popupwfb.'</div>';					    
				   $Popupwfb = $Popupwfb.'<p style="margin:0 !important;font-size:'.$header_font_size.'px !important;">'.$header_text.'</p>';
			      $Popupwfb = $Popupwfb.'</div>';
		         $Popupwfb = $Popupwfb.'<div id="easy" class="fancybox-content-inside"  style="background:'.$bg_color.';color:'.$color.';padding:15px;">';
				   $Popupwfb = $Popupwfb.'<p id="imgsection" style="width:40%;margin:'.$margin.';float:'.$imgposs.';border: 1px solid black;padding: 10px;">';
				   $Popupwfb = $Popupwfb.'<img src='.$image.'>';
				   $Popupwfb = $Popupwfb.'</p>';
				   $Popupwfb = $Popupwfb.'<p id="textsection" style="width:'.$textwidth.';margin:5px;float: left;margin: 5px;padding: 10px;">'.$content.'</p>';
					$Popupwfb = $Popupwfb.'<div style="clear:both">'; 
					$Popupwfb = $Popupwfb.'</div>';			      
			      $Popupwfb = $Popupwfb.'</div>';
		         $Popupwfb = $Popupwfb.'</div>';
          }
               $Popupwfb = $Popupwfb.'<script language="javascript" type="text/javascript">';  
		         $Popupwfb = $Popupwfb.'function closefancy() { 
												     parent.jQuery.fancybox.close();
												}';
					$Popupwfb = $Popupwfb.'</script>';		         
		         $Popupwfb = $Popupwfb.'<script language="javascript" type="text/javascript">';
		         $Popupwfb = $Popupwfb." addText = document.getElementById('simple-popup-with-fancybox').innerHTML;";
		         $Popupwfb = $Popupwfb.'</script>';	
			
		        if(($logged_in==1) && ($bool==0) ) 
		        {
		 			if((($start_date <= $date)  && ($end_date >= $date) && ($display_status == 'Yes')))   
					{
						if ( ((is_front_page()) && ($pages == 'Front')) || ((is_page_template()) && ($pages == 'Front')) ) 
						{
							echo $Popupwfb;	
						}
						if ( is_single() && $pages == 'Post' )
						{
							echo $Popupwfb;	
						}
						if (( is_archive() && ($pages == 'Archive')) || ((is_post_type_archive()) && ($pages == 'Archive')) || (((is_author()) && ($pages == 'Archive'))) )
						{
							 echo $Popupwfb;	
						}
						if ( ((is_home()) && ($pages == 'Home')) || ((is_page_template()) && ($pages == 'Home')) )
						{
							 echo $Popupwfb;	
						}
					}
				 }
				 if(($logged_in==0) && ($mobile_device==0) ) 
		         {
		 			if((($start_date <= $date)  && ($end_date >= $date) && ($display_status == 'Yes') ))   
					{
					if(($login_users ==1) && get_current_user_id() != '' ){
						if($userrole == $whoshow ){
						if ( ((is_front_page()) && ($pages == 'Front')) || ((is_page_template()) && ($pages == 'Front')) ) 
						{
							echo $Popupwfb;	
						}
						if ( is_single() && $pages == 'Post' )
						{
							echo $Popupwfb;	
						}
						if (( is_archive() && ($pages == 'Archive')) || ((is_post_type_archive()) && ($pages == 'Archive')) || (((is_author()) && ($pages == 'Archive'))) )
						{
							 echo $Popupwfb;	
						}
						if ( ((is_home()) && ($pages == 'Home')) || ((is_page_template()) && ($pages == 'Home')) )
						{
							 echo $Popupwfb;	
						}
					}//roll
							}	
				}
				}
            if(($logged_in==0) && ($mobile_device==1) && (!wp_is_mobile())) 
		      {
		 			if((($start_date <= $date)  && ($end_date >= $date) && ($display_status == 'Yes')))   
					{
						if(($login_users ==1) && get_current_user_id() != ''){
							if( $userrole == $whoshow ){
					   if ( ((is_front_page()) && ($pages == 'Front')) || ((is_page_template()) && ($pages == 'Front')) ) 
						{
							echo $Popupwfb;	
						}
						if ( is_single() && $pages == 'Post' )
						{
							echo $Popupwfb;	
						}
						if (( is_archive() && ($pages == 'Archive')) || ((is_post_type_archive()) && ($pages == 'Archive')) || (((is_author()) && ($pages == 'Archive'))) )
						{
							 echo $Popupwfb;	
						}
						if ( ((is_home()) && ($pages == 'Home')) || ((is_page_template()) && ($pages == 'Home')) )
						{
							 echo $Popupwfb;	
						}
					}//role
			      }
			      }	  
            }
             if(($logged_in==0) && ($mobile_device==0) ) 
		         {
		 			if((($start_date <= $date)  && ($end_date >= $date) && ($display_status == 'Yes') ))   
					{
					if(($login_users ==0)){
						if ( ((is_front_page()) && ($pages == 'Front')) || ((is_page_template()) && ($pages == 'Front')) ) 
						{
							echo $Popupwfb;	
						}
						if ( is_single() && $pages == 'Post' )
						{
							echo $Popupwfb;	
						}
						if (( is_archive() && ($pages == 'Archive')) || ((is_post_type_archive()) && ($pages == 'Archive')) || (((is_author()) && ($pages == 'Archive'))) )
						{
							 echo $Popupwfb;	
						}
						if ( ((is_home()) && ($pages == 'Home')) || ((is_page_template()) && ($pages == 'Home')) )
						{
							 echo $Popupwfb;	
						}
					
							}	
				}
				}
				 if(($logged_in==0) && ($mobile_device==1) && (!wp_is_mobile())) 
		      {
		 			if((($start_date <= $date)  && ($end_date >= $date) && ($display_status == 'Yes')))   
					{
						if(($login_users ==0)){
						
					   if ( ((is_front_page()) && ($pages == 'Front')) || ((is_page_template()) && ($pages == 'Front')) ) 
						{
							echo $Popupwfb;	
						}
						if ( is_single() && $pages == 'Post' )
						{
							echo $Popupwfb;	
						}
						if (( is_archive() && ($pages == 'Archive')) || ((is_post_type_archive()) && ($pages == 'Archive')) || (((is_author()) && ($pages == 'Archive'))) )
						{
							 echo $Popupwfb;	
						}
						if ( ((is_home()) && ($pages == 'Home')) || ((is_page_template()) && ($pages == 'Home')) )
						{
							 echo $Popupwfb;	
						}
					
			      }
			      }	  
            }
       endwhile;
	}
wp_reset_query();  // Restore global post data stopped by the_post().
}
add_action('wp_enqueue_scripts', 'viva_wepu_Popupwfb_add_javascript_files');
function viva_wepu_Popupwfb_add_javascript_files() 
{
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery.fancybox-1.3.4.pack', plugin_dir_url( __FILE__ ).'fancybox/jquery.fancybox-1.3.4.pack.js');
		wp_enqueue_script('jquery.fancybox-1.3.4', plugin_dir_url( __FILE__ ).'fancybox/jquery.fancybox-1.3.4.js');
		wp_enqueue_style('jquery.fancybox-1.3.4', plugin_dir_url( __FILE__ ).'fancybox/jquery.fancybox-1.3.4.css');
}  
add_action('admin_enqueue_scripts', 'viva_wepu_Popupwfb_add_javascript_files_admin');

add_action('admin_enqueue_scripts', 'viva_wepu_Popupwfb_add_javascript_files_admin');

function viva_wepu_Popupwfb_add_javascript_files_admin() 
{	
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style( 'jquery-ui', plugin_dir_url( __FILE__ ).'css/jquery-ui.css');
		wp_enqueue_script('date-picker', plugin_dir_url( __FILE__ ).'js/date-picker.js');	
}

	
  // colorpicker scripts
	add_action( 'admin_enqueue_scripts', 'viva_wepu_mw_enqueue_color_picker' );
		
	function viva_wepu_mw_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker');
    wp_enqueue_script( 'wp-color-picker');
   }
  
/**
	 * Register custom post types
	 * @return void
	 */
	function viva_wepu_register_spopup() 
	{
		$labels = array(
		'name'                 =>  'SPopup', 
		'singular_name'        => 	'SPopup', 
		'all_items'            => 	'All SPopup', 
		'add_new'              =>	__( "Add New", "SPopup"), 
		'add_new_item'         => 	__( "Add New", "SPopup"), 
		'edit_item'            => 	__( "Edit", "SPopup"),
		'new_item'             => 	__( "New", "SPopup"), 
		'view_item'            => 	__( "View", "SPopup"), 
		'search_items'         =>  __( "Search", "SPopup"),
		'not_found'            => 	__( "No Popup found", "SPopup"), 
		'not_found_in_trash'   => 	__( "No Popup found in Trash", "SPopup"),
		'parent_item_colon'    => ''
	);
	$args = array(
		'labels'               => $labels,
		'public'               => true,
		'publicly_queryable'   => true,
		'_builtin'             => false,
		'show_ui'              => true, 
		'query_var'            => true,
		'rewrite'              => array( "slug" => "SPopup" ),
		'capability_type'      => 'post',
		'hierarchical'         => false,
		'menu_position'        => 20,
		'supports'             => array( 'title','thumbnail', 'page-attributes' ),
		'taxonomies'           => array(),
		'has_archive'          => true,
		'show_in_nav_menus'    => false,
		'supports'           => array( 'title', 'editor' )
	);
	register_post_type( 'spopup', $args );
	}
	add_action( 'init', 'viva_wepu_register_spopup' );
	// add language folder
function viva_wepu_ap_action_init()
{
// Localization
load_plugin_textdomain('wp-easy-popup', false, dirname(plugin_basename(__FILE__)).'/languages');
}

// Add actions
add_action('init', 'viva_wepu_ap_action_init');	
	
//Add our metaboxes
add_action( 'add_meta_boxes', 'viva_wepu_book_meta_box_add' );
function viva_wepu_book_meta_box_add()
{
    add_meta_box( 'my-meta-box-id_1', 'Appreance', 'viva_wepu_popup_meta_details', 'spopup', 'normal', 'high' );
}
function viva_wepu_popup_meta_details() 
{
//	$box_width = $_POST['box_width'];
    $postid=get_the_ID(); 
    $close_button = get_post_meta($postid, 'red_round', true);
	 $header_text = get_post_meta($postid, 'header_text', true);
	 $header_font_size = get_post_meta($postid, 'header_font_size', true);
	 $header_background_color = get_post_meta($postid, 'header_background_color', true);
	 $header_color = get_post_meta($postid, 'header_color', true);
	 $image = get_post_meta($postid, 'image', true);	 
	 $popup_timeout = get_post_meta($postid, 'popup_timeout', true);
	 $popup_close = get_post_meta($postid, 'popup_close', true);
    $bg_color = get_post_meta($postid, 'background_color', true);
	 $color = get_post_meta($postid, 'color', true);
	 $close_color = get_post_meta($postid, 'close_color', true);
	 $close_color_1 = get_post_meta($postid, 'close_color_1', true);
	 $opacity = get_post_meta($postid, 'opacity', true);
	 $start_date = get_post_meta($postid, 'start_date', true);
	 $end_date = get_post_meta($postid, 'end_date', true);
	 $logged_in = get_post_meta($postid, 'logged_in', true);
	 $mobile_device = get_post_meta($postid, 'mobile_device', true);
	 $login_users= get_post_meta($postid, 'loginuser', true);
	 $whoshow= get_post_meta($postid, 'whoshow', true);
   $imgposs = get_post_meta($postid,'img_position',true);
   
	wp_nonce_field( plugin_basename( __FILE__ ), 'custom_meta_box_nonce' );
 
	?>
<form>

		<input type="hidden" name="oscimp_hidden" value="Y">
			<table class="form-table">
				<th>
					<label class="spu-label" for="spu-color"><?php 
					_e( 'Popup Display Page Type','wp-easy-popup');  ?></label>
					</th>
					<td>	
						<select name="page_type">						
<?php 
						  $page_types = array('Home','Archive', 'Front', 'Post');
                	  $postid=get_the_ID();
                    $curmenutype = get_post_meta($postid,'page_type',true);
                    foreach ($page_types as $type)
                    {
                        echo "<option value=\"$type\"". ($type == $curmenutype ? " selected":""). ">$type</option>";
                    }
?>
             		</select>							
				   </td>		
				<tr>
					<td colspan="2">
					<div style="font-size: 25px;font-weight: bold;font-style: italic;color: black;">HEADER SECTION<div>					
					</td>				
				</tr>		
				<tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Header Text','wp-easy-popup'); ?></label>
						</th>
						<td>
							<input name="header_text" id="spu-header-text" type="text" class="small" value="<?php echo $header_text; ?>" />	
						</td>
					</tr>
	         <tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Header Font Size','wp-easy-popup'); ?></label>
						</th>
						<td colspan="3">
				<input id="spu-font-size" name="header_font_size" id="spu-box-width" type="range" class="header_font_size" min="10" step="1" max="60" onchange="updateTextInput(this.value);" value="<?php echo $header_font_size; ?>" /><span class="hint">px</span>
							<input type="text" style="width: 30px;margin-left: 20px;" id="textInput" value="<?php echo $header_font_size; ?>" readonly />
							<p class="hint"><?php _e( 'Enter font size of header content in px. (Ex: 20).','wp-easy-popup' ) ?></p>
						</td>
					</tr>
					<script type="text/javascript">
						    function updateTextInput(val) {
						      document.getElementById('textInput').value=val; 
						    }
				</script>
			<tr valign="top">
					<th>
						<label class="spu-label" for="spu-header-color"><?php _e( 'Header Text color','wp-easy-popup'); ?></label>
					</th>	
						<td>
						<input id="spu-background-color" name="header_color" data-default-color="#effeff" type="text" class="header_color" value="<?php echo $header_color; ?>" />
						</td>
						<script type="text/javascript">
						jQuery(document).ready(function(jQuery){
         			jQuery('.header_color').wpColorPicker();    
      				});
     					</script>
					</tr>
			<tr valign="top">
					<th>
						<label class="spu-label" for="spu-header-background-color"><?php _e( 'Header Background Color','wp-easy-popup' ); ?></label>
					</th>
					<td>							
						<input id="spu-background-color" data-default-color="#effeff" class="header_background_color"  name="header_background_color" type="text" class="spu-color-field" value="<?php echo $header_background_color; ?>" />
					</td>
					<script type="text/javascript" >
					jQuery(document).ready(function(){
         			jQuery('.header_background_color').wpColorPicker();    
      				});
     				</script>
					</tr>	
		<tr>
					<td colspan="2">
							<div style="font-size: 25px;font-weight: bold;font-style: italic;color: black;">IMAGE SECTION</div>					
					</td>				
				</tr>			
			<tr valign="top">
					
		
					<td>
						<input type="text" name="image" id="spu-image" value="<?php echo $image; ?>" class="image" />
						<input type='button' class="button-primary" value="Upload Image" id="uploadimage"/><input type='button' class="button-primary removebtn" value="Remove"  onclick="abccc()"/><br />
						<span class="description">Add Image To Add In Your Pop-Up.</span>
						<script type="text/javascript">
						var imageurll;
				    		jQuery(document).ready(function($){
									jQuery( '#uploadimage' ).on( 'click', function() {

								tb_show('test', 'media-upload.php?type=image&TB_iframe=1');
						
										window.send_to_editor = function( html ) 
										{
										   imgurl = jQuery(html).attr('src');
											jQuery( '#spu-image' ).val(imgurl);
											jQuery(".iframee").attr("src",imgurl);						
											$('.iframee').css('display','block');
											tb_remove();
											
										}
										
									});
									
								});	
	               </script>
					</td>
<?php

				  if(empty($image)) 
				  {
				  	  $imagesrc = plugins_url( 'wp-easy-popup/images/no-image-box.png', dirname(__FILE__) );
				  	  
				  	 }
				  	else 
				  	{
						//$imagesrc =plugins_url( 'wp-easy-popup/images/'.$imageno, dirname(__FILE__) ) ;
						}
?>
					</td>
					<th style="position: relative;">
					
						<label class="spu-label" for="spu-preview"><?php _e( 'Image Preview','wp-easy-popup') ?></label>
						<style type="text/css">
						.removebtn{margin-left: 10px !important;}
						</style>
						<script type="text/javascript">
						function abccc() {
                     	jQuery( '#spu-image' ).val('');
						      jQuery('.iframee').css('display','none');
								jQuery( ".clbtn" ).remove();
                     	
                     }
                    
                     
	   
						</script>
						
						 <iframe frameborder="0" scrolling="no" width="300" height="300"
                                 src="<?php echo $image; ?>" class="iframee" name="imgbox" id="imgbox">
                    <p>iframes are not supported by your browser.</p>
                   </iframe>
                   				
					</th>
		  </tr>
		  <tr>	  <tr>
		  <th>
			<label class="spu-label" for="spu-background-color"><?php _e( 'Image Position','wp-easy-popup' ); ?></label>
					</th>
		  <td><select name="imgpos">
					   <option value="">Select Image Poition</option>
					   <option value="none" <?php if($imgposs == 'none' && isset($imgposs)){ ?>selected="selected" <?php }?> >Center</option>
                  <option value="right" <?php if($imgposs == 'right' && isset($imgposs)){echo 'selected'; }?>>Right</option>
                  <option value="left" <?php if($imgposs == 'left' && isset($imgposs)){echo 'selected'; }?>>Left</option>  
                  <option value="full" <?php if($imgposs == 'full' && isset($imgposs)){echo 'selected'; }?> >Full</option>
					</select></td></tr>
		<tr>
					<td colspan="2">
							<div style="font-size: 25px;font-weight: bold;font-style: italic;color: black;">POPUP STYLING SECTION</div>					
					</td>				
				</tr>	  
				<tr valign="top">
					<th>
						<label class="spu-label" for="spu-background-color"><?php _e( 'Background Color','wp-easy-popup' ); ?></label>
					</th>
					<td>							
						<input id="spu-background-color" data-default-color="#effeff" class="bg_color"  name="background_color" type="text" class="spu-color-field" value="<?php echo $bg_color; ?>" />
					</td>
					
					</tr>
					<tr valign="top">
					<th>
						<label class="spu-label" for="spu-color"><?php _e( 'Text color','wp-easy-popup'); ?></label>
					</th>	
						<td>
						<input id="spu-background-color" name="color" data-default-color="#effeff" type="text" class="color" value="<?php echo $color; ?>" />
						</td>
						<script type="text/javascript" >
      				jQuery(document).ready(function(){
         			jQuery('.color').wpColorPicker();    
      				});
     					</script>
					</tr>
					<tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Close Button','wp-easy-popup'); ?></label>
						</th>
						<td>
						<input id="spu-close-button-color" name="close_color" data-default-color="#effeff" type="text" class="close_color" value="<?php echo $close_color; ?>" />
						<p class="hint"><?php _e( 'Set Close Button Background-color','wp-easy-popup' ) ?></p>						
						</td>
						<script type="text/javascript" >
					 	jQuery(document).ready(function(){
         			jQuery('.close_color').wpColorPicker();    
      				});
     					</script>
					</tr>
					<tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Close Button Color','wp-easy-popup'); ?></label>
						</th>
						<td>
						<input id="spu-close-utton-color" name="close_color_1" data-default-color="white" type="text" class="close_color_1" value="<?php echo $close_color_1; ?>" />
						<p class="hint"><?php _e( 'Set Close Button Color of "X"','wp-easy-popup' ) ?></p>						
						</td>
						<script type="text/javascript" >
						jQuery(document).ready(function(){
         			jQuery('.close_color_1').wpColorPicker();    
      				});
     					</script>
					</tr>
					<tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Popup close','wp-easy-popup'); ?></label>
						</th>
						<td>
							<input id="popup_time_close"  name="popup_close"  type="text" class="small" value="<?php echo $popup_close; ?>" />
							<p class="hint"><?php _e( 'Enter your popup window close time in millisecond. (Ex: 3000).','wp-easy-popup') ?></p>
						</td>
					</tr>
					
					<tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Popup TimeIn','wp-easy-popup'); ?></label>
						</th>
						<td>
							<input id="popup_time"  name="popup_timeout"  type="text" class="small" onload="done()" value="<?php echo $popup_timeout; ?>" />
							<p class="hint"><?php _e( 'Enter your popup window timeIn Should be grater then window load time in millisecond. (Ex: 3000).','wp-easy-popup') ?></p>
						</td>
					</tr>
					
					<tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Start Date','wp-easy-popup'); ?></label>
						</th>
						<td>
							<input  name="start_date" id="datepicker1"  type="text" class="small" value="<?php if( $start_date == ''){echo '00/00/0000'; }else{ echo $start_date; }?>" />
							<p class="hint"><?php _e( 'Please enter popup display start date in this format MM/DD/YYYY , 00/00/0000 : Is equal to no min date.','wp-easy-popup' ) ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Expire Date','wp-easy-popup'); ?></label>
						</th>
						<td>
							<input  name="end_date"  id="datepicker" type="text" class="" value="<?php  if( $end_date == ''){ echo '12/31/9999'; }else{echo $end_date;} ?>" />
							<p class="hint"><?php _e( 'Please enter the expiration date in this format MM/DD/YYYY , 12/31/9999 : Is equal to no expire.','wp-easy-popup' ) ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Hide Popup For Logged In Users ','wp-easy-popup'); ?></label>
						</th>
						<td>
							<input  name="logged_in"  id="" type="checkbox" class="" value="1" <?php echo ($logged_in == 1) ? 'checked="checked"' : ''; ?> />
							<p class="hint"><?php _e( ' ','wp-easy-popup' ) ?></p>
						</td>
					</tr>
						<tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Hide Popup In Mobile Devices ','wp-easy-popup'); ?></label>
						</th>
						<td>
							<input  name="mobile_device"  id="" type="checkbox" class="" value="1" <?php echo ($mobile_device == 1) ? 'checked="checked"' : ''; ?>  />
							<p class="hint"><?php _e( ' ','wp-easy-popup' ) ?></p>
						</td>

					</tr>
						<tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Popup Only for login user ','wp-easy-popup');  ?></label>
						</th>
						<td>
							<input  name="login_users"  id="" type="checkbox" class="" value="1" <?php echo ($login_users == 1) ? 'checked="checked"' : ''; ?>  />
							<p class="hint"><?php _e( ' ','wp-easy-popup' ) ?></p>
						</td>
					</tr>
						<tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Who to show ','wp-easy-popup');  ?></label>
						</th>
						<td>
							<select name="who_show">
							  <option value="">Select</option>
							  <option  <?php if($whoshow =='subscriber'){ echo 'selected';}?> value="subscriber">Subscriber</option>
								<option <?php if($whoshow =='contributor'){ echo 'selected';}?> value="contributor">Contributor</option>
								<option <?php if($whoshow =='author'){ echo 'selected';}?> value="author">Author</option>
								<option <?php if($whoshow =='editor'){ echo 'selected';}?> value="editor">Editor</option>
								<option <?php if($whoshow =='administrator'){ echo 'selected';}?> value="administrator">Administrator</option>	
							</select>
							<p class="hint"><?php _e( ' ','wp-easy-popup' ) ?></p>
						</td>
					</tr>
              <tr valign="top">
						<th>
							<label class="spu-label" ><?php _e( 'Popup Display Status','wp-easy-popup'); ?></label>
						</th>
						<td>
							<select name="display_status">						
						<?php 
							$display_status = array('Yes','No');
                		$postid=get_the_ID();
                    	$curstatustype = get_post_meta($postid,'display_status',true);
                    	foreach ($display_status as $type)
                    	{
                        echo "<option value=\"$type\"". ($type == $curstatustype ? " selected":""). ">$type</option>";
                    	}
                ?>
             		</select>								
							<p class="hint"><?php _e( 'Please select your popup display status. (Select No if you want to hide the popup )','wp-easy-popup' ) ?></p>
						</td>
					</tr>
				
				</table>
		</form>
<?php
}
add_action( 'save_post', 'viva_wepu_cd_meta_box_save11' );
function viva_wepu_cd_meta_box_save11( $post_id )
{
	$selected_item = null;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
  return;
if ( !wp_verify_nonce( $_POST['custom_meta_box_nonce'], plugin_basename( __FILE__ ) ) )
  return;
//	$prfx_stored_meta = get_post_meta( $post->ID );
  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }
  $popup_timeout = $_POST['popup_timeout'];
  if(!is_numeric($popup_timeout)) 
			{
				update_post_meta($post_id,'popup_timeout', 3000); 
			}
      else
			{
			   update_post_meta($post_id,'popup_timeout', $popup_timeout);
			}
	$header_font_sizes = sanitize_text_field($_POST['header_font_size']);
	$start_dates = sanitize_text_field($_POST['start_date']);
	$end_dates = sanitize_text_field($_POST['end_date']);
	$display_statuss = sanitize_text_field($_POST['display_status']);
	$logged_ins = sanitize_text_field($_POST['logged_in']);
	$mobile_devices = sanitize_text_field($_POST['mobile_device']);
   $login_users = sanitize_text_field($_POST['login_users']);
    $whoshow = sanitize_text_field($_POST['who_show']);	
    $imgposition = sanitize_text_field($_POST['imgpos']);
			
   $popup_close = sanitize_text_field($_POST['popup_close']);
  	update_post_meta($post_id,'popup_close', $popup_close);
	$header_text =sanitize_text_field($_POST['header_text']);
  	update_post_meta($post_id,'header_text', $header_text);
  	$header_font_size = isset($header_font_sizes) ? $header_font_sizes : 30 ;
  	update_post_meta($post_id,'header_font_size', $header_font_size);
   $header_background_color = sanitize_text_field($_POST['header_background_color']);
  	update_post_meta($post_id,'header_background_color', $header_background_color);
  	$header_color = sanitize_text_field($_POST['header_color']);
  	update_post_meta($post_id,'header_color', $header_color);
  	$image = sanitize_text_field($_POST['image']);
  	update_post_meta($post_id,'image', $image);		 
	$bg_color = sanitize_text_field($_POST['background_color']);
  	update_post_meta($post_id,'background_color', $bg_color);
   $color = sanitize_text_field($_POST['color']);
  	update_post_meta($post_id,'color', $color);
  	$close_color = sanitize_text_field($_POST['close_color']);
  	update_post_meta($post_id,'close_color', $close_color);
  	$close_color_1 = sanitize_text_field($_POST['close_color_1']);
  	update_post_meta($post_id,'close_color_1', $close_color_1);
   $pages = sanitize_text_field($_POST['page_type']);
  	update_post_meta($post_id,'page_type', $pages);
  	$start_date = isset($start_dates) ? $start_dates : 00/00/0000;
  	update_post_meta($post_id,'start_date', $start_date);
  	$end_date = isset($end_dates) ? $end_dates : 12/31/9999; 
  	update_post_meta($post_id,'end_date', $end_date);
  	$display_status = isset($display_statuss) ? $display_statuss : 'Yes' ;
  	update_post_meta($post_id,'display_status',$display_status);
  	$logged_in = isset($logged_ins) ? $logged_ins : 0;
  	update_post_meta($post_id,'logged_in',$logged_in);
  	$mobile_device = isset($mobile_devices) ? $mobile_devices : 0;
  	update_post_meta($post_id,'mobile_device',$mobile_device);
  if(isset($imgposition)){
  	update_post_meta($post_id,'img_position',$imgposition);
  }
  if(isset($login_users)){
  update_post_meta($post_id, 'loginuser', $login_users);}
  if(isset($whoshow)){
  update_post_meta($post_id, 'whoshow', $whoshow);}
  }

?>