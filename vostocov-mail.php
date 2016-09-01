
<?php
/*
Plugin Name: Vostocov mail
Plugin URI: 
Description: A simple contact form for simple needs.
Version: 1.0
Author: Positron Bohemia
Author URI: 
*/

//--------------------------------------------------------------------------------------------------------------//
// CODE FOR DEFINING CONSTANTS
//--------------------------------------------------------------------------------------------------------------//
$running_year = date("Y");
$running_month = date("m");
$today_date = date("d");

//if (!defined("GALLERY_MASTER_FILE")) define("GALLERY_MASTER_FILE","gallery-master/gallery-master.php");
if (!defined("VOSTOCOV_MAIL_PLUGIN_DIR")) define("VOSTOCOV_MAIL_PLUGIN_DIR",  plugin_dir_path(__FILE__));
//if (!defined("GALLERY_MASTER_BK_PLUGIN_DIRNAME")) define("GALLERY_MASTER_BK_PLUGIN_DIRNAME", plugin_basename(dirname(__FILE__)));
//if (!defined("GALLERY_MASTER_BK_PLUGIN_URL")) define("GALLERY_MASTER_BK_PLUGIN_URL", content_url()."/plugins/".GALLERY_MASTER_BK_PLUGIN_DIRNAME );
//if (!defined("GALLERY_MASTER_MAIN_DIR")) define("GALLERY_MASTER_MAIN_DIR", dirname(dirname(dirname(__FILE__)))."/gallery-master/");
//if (!defined("GALLERY_MASTER_YEAR_DIR")) define("GALLERY_MASTER_YEAR_DIR", GALLERY_MASTER_MAIN_DIR.$running_year."/");
//if (!defined("GALLERY_MASTER_MONTH_DIR")) define("GALLERY_MASTER_MONTH_DIR", GALLERY_MASTER_YEAR_DIR.$running_month."/");
//if (!defined("GALLERY_MASTER_DATE_DIR")) define("GALLERY_MASTER_DATE_DIR", GALLERY_MASTER_MONTH_DIR.$today_date."/");
//if (!defined("GALLERY_MASTER_UPLOAD_DIR")) define("GALLERY_MASTER_UPLOAD_DIR", GALLERY_MASTER_DATE_DIR."uploads/");
//if (!defined("GALLERY_MASTER_THUMBS_DIR")) define("GALLERY_MASTER_THUMBS_DIR", GALLERY_MASTER_DATE_DIR."thumbs/");
//if (!defined("GALLERY_MASTER_UPLOAD_PATH")) define("GALLERY_MASTER_UPLOAD_PATH", $running_year."/".$running_month."/".$today_date."/");
//if (!defined("GALLERY_MASTER_MAIN_URL")) define("GALLERY_MASTER_MAIN_URL", content_url()."/gallery-master/");
//if (!defined("GALLERY_MASTER_THUMBS_URL")) define("GALLERY_MASTER_THUMBS_URL", content_url()."/gallery-master/".GALLERY_MASTER_UPLOAD_PATH."thumbs/");
//if (!defined("gallery_master")) define("gallery_master", "gallery-master");


//--------------------------------------------------------------------------------------------------------------//
// FUNCTION FOR INSTALLING PLUGIN
//--------------------------------------------------------------------------------------------------------------//

if(!function_exists("plugin_install_script_for_vostocov_mail"))
{
	function plugin_install_script_for_vostocov_mail()
	{
		global $wpdb,$current_user,$user_role_permission;

		if(is_super_admin())
		{
			$gm_role = "administrator";
		}
		else
		{
			$gm_role = $wpdb->prefix . "capabilities";
			$current_user->role = array_keys($current_user->$gm_role);
			$gm_role = $current_user->role[0];
		}

		if (is_multisite())
		{
			$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach($blog_ids as $blog_id)
			{
				switch_to_blog($blog_id);
				if(file_exists(VOSTOCOV_MAIL_PLUGIN_DIR. "lib/install.php"))
				{
					include VOSTOCOV_MAIL_PLUGIN_DIR . "lib/install.php";
				}
				restore_current_blog();
			}
		}
		else
		{
			if (file_exists(VOSTOCOV_MAIL_PLUGIN_DIR . "lib/install.php"))
			{
				include_once VOSTOCOV_MAIL_PLUGIN_DIR . "lib/install.php";
			}
		}
	}
}

//--------------------------------------------------------------------------------------------------------------//
// FUNCTION FOR CREATING SIDEBAR MENUS
//--------------------------------------------------------------------------------------------------------------//

if(!function_exists("create_global_menus_for_vostocov_mail"))
{
	function create_global_menus_for_vostocov_mail()
	{
		global $current_user, $wpdb, $user_role_permission;

		if(is_super_admin())
		{
			$gm_role = "administrator";
		}
		else
		{
			$gm_role = $wpdb->prefix . "capabilities";
			$current_user->role = array_keys($current_user->$gm_role);
			$gm_role = $current_user->role[0];
		}

		if (file_exists(VOSTOCOV_MAIL_PLUGIN_DIR . "lib/sidebar_menu.php"))
		{
			include_once VOSTOCOV_MAIL_PLUGIN_DIR . "lib/sidebar_menu.php";
		}
	}
}

//--------------------------------------------------------------------------------------------------------------//
// FUNCTION FOR CREATING TOPBAR MENUS
//--------------------------------------------------------------------------------------------------------------//

if(!function_exists("create_top_bar_gallery_master_menu"))
{
	function create_top_bar_gallery_master_menu($meta = TRUE)
	{

	}
}

//--------------------------------------------------------------------------------------------------------------//
// FUNCTION FOR SHORTCODE
//--------------------------------------------------------------------------------------------------------------//

if(!function_exists("gallery_master_short_code"))
{
	function gallery_master_short_code($atts)
	{
		extract(shortcode_atts(array(
			"theme" => "",
			"source_type" => "",
			"ids" => "",
			"id" => "",
			"gallery_type" => "",
			"layout" => "",
			"show_title" => "",
			"show_desc" => "",
			"height" => "",
			"width" => "",
			"border_style" => "",
			"margin" => "",
			"padding" => "",
			"title_color" => "",
			"desc_color" => "",
			"lightbox" => "",
			"order_by" => "",
		), $atts));
		if(!is_feed())
		{
		return extract_short_code_for_gallery_master_images($theme,$source_type,urldecode($ids),intval($id),$gallery_type,$layout,$show_title,$show_desc,$height,$width,$border_style,$margin,$padding,$title_color,$desc_color,$lightbox,$order_by);
		}
	}
}

//--------------------------------------------------------------------------------------------------------------//
// FUNCTION FOR EXTRACTING SHORTCODE
//--------------------------------------------------------------------------------------------------------------//

if(!function_exists("extract_short_code_for_gallery_master_images"))
{
	function extract_short_code_for_gallery_master_images($theme,$source_type,$gallery_ids,$gallery_id,$gallery_type,$layout,$show_title,$show_desc,$thumb_height,$thumb_width,$border_style,$margin,$padding,$title_color,$desc_color,$lightbox,$order_by)
	{
		ob_start();

		include VOSTOCOV_MAIL_PLUGIN_DIR . "users-views/helper.php";
		include VOSTOCOV_MAIL_PLUGIN_DIR . "users-views/include-before.php";

		switch($theme)
		{
			case "thumbnails":
				include VOSTOCOV_MAIL_PLUGIN_DIR . "users-views/thumbnail-gallery.php";
			break;

			case "masonry":
				include GALLERY_MASTER_BK_PLUGIN_DIR . "users-views/masonry-gallery.php";
			break;
		}

		include VOSTOCOV_MAIL_PLUGIN_DIR . "users-views/include-after.php";

		$gallery_master_output = ob_get_clean();
		wp_reset_query();
		return $gallery_master_output;
	}
}


//--------------------------------------------------------------------------------------------------------------//
// CALL HOOKS
//--------------------------------------------------------------------------------------------------------------//

// add_action Hook called for creating thumbnail folders
add_action("admin_init", "gallery_master_thumbnail_folder");

// activation Hook called for installation of Gallery Master
register_activation_hook(__FILE__, "plugin_install_script_for_gallery_master");

// uninstall Hook called for uninstallation of Gallery Master
register_uninstall_hook( __FILE__, "plugin_uninstall_script_for_gallery_master");

// add_action Hook called for adding languages
add_action("plugins_loaded", "gallery_master_plugin_load_text_domain");

// add_action Hook called for creating global menus
add_action("admin_menu", "create_global_menus_for_gallery_master");

// add_action Hook called for creating menus on admin bar
add_action("admin_bar_menu", "create_top_bar_gallery_master_menu", 100);

// add_action Hook called for adding css on backend
add_action("admin_init", "gallery_master_backend_css_calls");

// add_action Hook called for adding js on backend
add_action("admin_init", "gallery_master_backend_scripts_calls");

// add_action Hook called for adding js on frontend
add_action("init", "gallery_master_frontend_scripts_calls");

// add_action Hook called for adding css on frontend
add_action("init", "gallery_master_frontend_css_calls");

// add_action Hook called for creating helper class
add_action("admin_init", "create_gallery_master_helper_class");

// add_action Hook called for registering libraries
add_action("admin_init", "create_ajax_library_gallery_master");

// add_shortcode hook called to add shortcode on page/post
add_shortcode("gallery_master", "gallery_master_short_code");

add_action("in_plugin_update_message-".GALLERY_MASTER_FILE,"gallery_master_plugin_update_message" );
?>
