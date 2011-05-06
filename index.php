<?php
/*
Plugin Name: Update Admin Footer
Plugin URI: http://www.onestepsolutions.biz
Description: This plugin update your admin footer text without opening the code files.
Version: 1.0.1
Author: Kamran Shahid Butt
Author URI: http://www.onestepsolutions.biz
*/
/*  Copyright 2011 One Step Solutions  

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if(isset($_POST['oss_update_admin_footer_submit']))
{
	$option_name = 'oss_update_admin_footer_logo' ; 
	$newvalue = $_POST['oss_update_admin_footer_logo'];
	if ( get_option($option_name)  != $newvalue) {
		update_option($option_name, $newvalue);
	} 
	else {
		$deprecated=' ';
		$autoload='no';
		add_option($option_name, $newvalue, $deprecated, $autoload);
	}
	
	$option_name = 'oss_update_admin_footer_url_text' ; 
	$newvalue = $_POST['oss_update_admin_footer_url_text'];
	if ( get_option($option_name)  != $newvalue) {
		update_option($option_name, $newvalue);
	} 
	else {
		$deprecated=' ';
		$autoload='no';
		add_option($option_name, $newvalue, $deprecated, $autoload);
	}
	
	
	$option_name = 'oss_update_admin_footer_url' ; 
	$newvalue = $_POST['oss_update_admin_footer_url'];
	if ( get_option($option_name)  != $newvalue) {
		update_option($option_name, $newvalue);
	} 
	else {
		$deprecated=' ';
		$autoload='no';
		add_option($option_name, $newvalue, $deprecated, $autoload);
	}
	
}

add_action('admin_menu', 'oss_update_footer');

function oss_update_footer()
{
	add_submenu_page( "options-general.php", 'Update Admin Footer', "Update Admin Footer", "manage_options", 'update-admin-footer', 'oss_update_admin_footer_html');
}

function oss_update_admin_footer_html()
{
	if (!current_user_can('manage_options'))
		wp_die( __('You do not have sufficient permissions to access this page.') );

		echo '
			<div class="wrap">
					<h2>Update Admin Footer</h2>
					<form method="post" id="frm" name="frm">
					<div>
						<table>
							<tr>
								<td><label>Footer logo</label></td>
								<td><input type="text" value="'.get_option("oss_update_admin_footer_logo").'" id="oss_update_admin_footer_logo" name="oss_update_admin_footer_logo" /></td>
							</tr>
							<tr>
								<td><label>Footer URL Text</label></td>
								<td><input type="text" value="'.get_option("oss_update_admin_footer_url_text").'" id="oss_update_admin_footer_url_text" name="oss_update_admin_footer_url_text" /></td>
								
							</tr>
							<tr>
								<td><label>Footer Url</label></td>
								<td><input type="text" value="'.get_option("oss_update_admin_footer_url").'" id="oss_update_admin_footer_url" name="oss_update_admin_footer_url" /></td>
								
							</tr>
							<tr>
								<td></td>
								<td><input type="hidden" value="oss_update_admin_footer_submit" name="oss_update_admin_footer_submit">
						<p><input type="submit" value="Save" name="submit"></td>
								
							</tr>
							
							
							<tr>
								<td colspan="2"><h3>Preview</h3></td>
							</tr>
							<tr>
								<td>';
					if(strlen(get_option("oss_update_admin_footer_logo")))
						$out = '<span id="footer-thankyou"><img src="'.get_option("oss_update_admin_footer_logo").'" alt="" width="17" height="auto" style="margin-bottom:-6px;"/></span>';
					if(strlen(get_option("oss_update_admin_footer_url")) and strlen(get_option("oss_update_admin_footer_url_text")))
						$out .= '<a href="'.get_option("oss_update_admin_footer_url").'">'.get_option("oss_update_admin_footer_url_text").'</a>';
					elseif(strlen(get_option("oss_update_admin_footer_url_text")) and !strlen(get_option("oss_update_admin_footer_url")))
						$out .= get_option("oss_update_admin_footer_url_text");
				echo $out;
				echo			'</td>
								<td></td>
								
							</tr>
							
							
						</table>
				</div>
					</form>
				</div>';

}


add_action( 'admin_footer_text', 'oss_update_admin_footer');
function oss_update_admin_footer() {
	if(strlen(get_option("oss_update_admin_footer_logo")))
		$out = '<span id="footer-thankyou"><img src="'.get_option("oss_update_admin_footer_logo").'" alt="" width="17" height="auto" style="margin-bottom:-6px;"/></span>';
	if(strlen(get_option("oss_update_admin_footer_url")) and strlen(get_option("oss_update_admin_footer_url_text")))
		$out .= '<a href="'.get_option("oss_update_admin_footer_url").'">'.get_option("oss_update_admin_footer_url_text").'</a>';
	elseif(strlen(get_option("oss_update_admin_footer_url_text")) and !strlen(get_option("oss_update_admin_footer_url")))
		$out .= get_option("oss_update_admin_footer_url_text");
		
	echo $out;
}
?>