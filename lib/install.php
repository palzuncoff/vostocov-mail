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

		if(!class_exists("tech_prodigy_save_data"))
		{
			class tech_prodigy_save_data
			{
				/**
				 * @param $tbl
				 * @param $data
				 * @return mixed
				 */
				function insert_data($tbl, $data)
				{
					global $wpdb;
					$wpdb->insert($tbl, $data);
					return $wpdb->insert_id;
				}

				/**
				 * @param $tbl
				 * @param $data
				 * @param $where
				 */
				function update_data($tbl, $data, $where)
				{
					global $wpdb;
					$wpdb->update($tbl, $data, $where);
				}

				/**
				 * @param $tbl
				 * @param $where
				 */
				function delete_data($tbl, $where)
				{
					global $wpdb;
					$wpdb->delete($tbl, $where);
				}

				/**
				 * @param $tbl
				 * @param $where
				 * @param $data
				 */

				function bulk_delete_data($tbl,$where,$data)
				{
					global $wpdb;
					$wpdb->query("DELETE FROM $tbl WHERE $where IN ($data)");
				}

			}
		}
		
		require_once(ABSPATH . "wp-admin/includes/upgrade.php");
		$vostocov_mail_version = get_option("vostocov_mail-key");
		
		/****************************************** FUNCTION FOR CREATING TABLES ************************************/

		if(!function_exists("create_table_vostocov_mail"))
		{
			function create_table_vostocov_mail ()
			{
				$sql = "CREATE TABLE IF NOT EXISTS vostocov_addressees (
				`addressee_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`addressee_name` varchar(100) NOT NULL,
        `addressee_birth_date` varchar(100) NOT NULL,
        `addressee_city` varchar(100) NOT NULL,
        `addressee_adress` varchar(100) NOT NULL,
        `addressee_email` varchar(100) NOT NULL,
				PRIMARY KEY (`addressee_id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
				dbDelta($sql);
			}
		}
		
		/************************************* CODE FOR CREATING DATABASE ************************************/
		switch ($vostocov_mail_version)
		{
			case "":
				create_table_vostocov_mail();
			break;
		}
		
		update_option("vostocov-mail-key", "1.0");
    update_option("vostocov-mail-automatic_update", "1");
	}
}
?>