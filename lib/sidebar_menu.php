<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!is_user_logged_in())
{
	return;
}
else
{
	switch($gm_role)
	{
		case "administrator":
			$user_role_permission = "manage_options";
		break;

		case "editor":
			$user_role_permission = "publish_pages";
		break;

		case "author":
			$user_role_permission = "publish_posts";
		break;

		case "contributor":
			$user_role_permission = "edit_posts";
		break;

		case "subscriber":
			$user_role_permission = "read";
		break;
	}
	
	if (!current_user_can($user_role_permission))
	{
		return;
	}
	else
	{
		switch ($gm_role)
		{
			case "administrator":
				add_menu_page("Vostocov mail", __("Vostocov mail", vostocov_mail), "read", "vostocov_mail", "", plugins_url("assets/admin/images/icon.png",dirname(__FILE__)));
				add_submenu_page("vostocov_mail", "Dashboard", __("Dashboard", vostocov_mail), "read", "vostocov_mail","vostocov_mail");
				add_submenu_page("", "", "", "read", "gm_save_basic_details", "gm_save_basic_details");
				add_submenu_page("", "", "", "read", "gm_upload_media", "gm_upload_media");
				add_submenu_page("", "", "", "read", "gm_save_gallery", "gm_save_gallery");
				add_submenu_page("", "", "", "read", "gm_shortcode_generator", "gm_shortcode_generator");
				add_submenu_page("", "", "", "read", "gm_feature_request", "gm_feature_request");
				add_submenu_page("", "", "", "read", "gm_premium_editions", "gm_premium_editions");
				add_submenu_page("", "", "", "read", "gm_system_information", "gm_system_information");
			break;

			case "editor":
				add_menu_page("Gallery Master", __("Gallery Master", gallery_master), "read", "gallery_master", "", plugins_url("assets/admin/images/icon.png",dirname(__FILE__)));
				add_submenu_page("gallery_master", "Dashboard", __("Dashboard", gallery_master), "read", "gallery_master","gallery_master");
				add_submenu_page("", "", "", "read", "gm_save_basic_details", "gm_save_basic_details");
				add_submenu_page("", "", "", "read", "gm_upload_media", "gm_upload_media");
				add_submenu_page("", "", "", "read", "gm_save_gallery", "gm_save_gallery");
				add_submenu_page("", "", "", "read", "gm_shortcode_generator", "gm_shortcode_generator");
				add_submenu_page("", "", "", "read", "gm_feature_request", "gm_feature_request");
				add_submenu_page("", "", "", "read", "gm_premium_editions", "gm_premium_editions");
				add_submenu_page("", "", "", "read", "gm_system_information", "gm_system_information");
			break;

			case "author":
				add_menu_page("Gallery Master", __("Gallery Master", gallery_master), "read", "gallery_master", "", plugins_url("assets/admin/images/icon.png",dirname(__FILE__)));
				add_submenu_page("gallery_master", "Dashboard", __("Dashboard", gallery_master), "read", "gallery_master","gallery_master");
				add_submenu_page("", "", "", "read", "gm_save_basic_details", "gm_save_basic_details");
				add_submenu_page("", "", "", "read", "gm_upload_media", "gm_upload_media");
				add_submenu_page("", "", "", "read", "gm_save_gallery", "gm_save_gallery");
				add_submenu_page("", "", "", "read", "gm_shortcode_generator", "gm_shortcode_generator");
				add_submenu_page("", "", "", "read", "gm_feature_request", "gm_feature_request");
				add_submenu_page("", "", "", "read", "gm_premium_editions", "gm_premium_editions");
				add_submenu_page("", "", "", "read", "gm_system_information", "gm_system_information");
			break;

			case "contributor":
				add_menu_page("Gallery Master", __("Gallery Master", gallery_master), "read", "gallery_master", "", plugins_url("assets/admin/images/icon.png",dirname(__FILE__)));
				add_submenu_page("gallery_master", "Dashboard", __("Dashboard", gallery_master), "read", "gallery_master","gallery_master");
				add_submenu_page("", "", "", "read", "gm_save_basic_details", "gm_save_basic_details");
				add_submenu_page("", "", "", "read", "gm_upload_media", "gm_upload_media");
				add_submenu_page("", "", "", "read", "gm_save_gallery", "gm_save_gallery");
				add_submenu_page("", "", "", "read", "gm_shortcode_generator", "gm_shortcode_generator");
				add_submenu_page("", "", "", "read", "gm_feature_request", "gm_feature_request");
				add_submenu_page("", "", "", "read", "gm_premium_editions", "gm_premium_editions");
				add_submenu_page("", "", "", "read", "gm_system_information", "gm_system_information");
			break;
		}
  }
}