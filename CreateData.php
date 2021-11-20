<?php

function DBP_tb_create()
{
 global $wpdb;

    $DBP_tb_name = $wpdb->prefix ."dbp_tb_login";
    $DBP_query = "CREATE TABLE  {$wpdb->prefix}apinews
    (
    id int(11) NOT NULL AUTO_INCREMENT,
      `name_office` text COLLATE utf8mb4_persian_ci DEFAULT NULL,
      `api_address` text COLLATE utf8mb4_persian_ci DEFAULT NULL,
      PRIMARY KEY (id) 
    )";

    require_once (ABSPATH . "wp-admin/includes/upgrade.php");
    dbDelta($DBP_query);
}

function simple_plugin_deactivation()
{

}