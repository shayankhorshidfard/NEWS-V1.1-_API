<?php
/*
Plugin Name: پلاگین خبر
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description:  api پلاگین دریافت اخبار به صورت
Author: shayan khorshidfard
Text Domain: Online-api
Domain Path:/languages/
Version: 1.0.0
Author URI: https://github.com/shayankhorshidfard/online_api
*/
function get_latest_posts_by_category($request)
{
    $args = array(
        'category' => $request['category_id']
    );
    $posts = get_posts($args);
    if (empty($posts)) {
        return new WP_Error('empty_category', 'There are no posts to display', array('status' => 404));
    }
    $response = new WP_REST_Response($posts);
    $response->set_status(200);
}
define('WP_APIS_DIR', plugin_dir_path(__FILE__)); //name and cap
define('WP_APIS_URL', plugin_dir_url(__FILE__)); //name and cap
define('WP_APIS_INC', WP_APIS_DIR . '/inc/'); //name and cap
define('WP_APIS_TPL', WP_APIS_DIR . '/tpl/'); //name and cap
register_activation_hook(__FILE__, 'DBP_tb_create');
register_deactivation_hook(__FILE__, 'simple_plugin_deactivation');
function learningWordPress_resources(){
    wp_enqueue_script('main_js' , get_template_directory_uri() . '/inc/main.js');
    wp_enqueue_style('style_css' ,get_template_directory_uri() . '/tpl/admin/menus/style.css', array() , '1.0.1' , 'all');
}
//Include database file
include_once ("CreateData.php");
//register hook
register_activation_hook(__FILE__,'DBP_tb_create');
if (is_admin())
{
    include WP_APIS_INC. 'admin/menus.php';
    include WP_APIS_INC. 'admin/mtaboxes.php';
}
?>