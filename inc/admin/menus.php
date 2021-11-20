<style>
    .taga {
        padding: 10px;
        background-color: orange;
        color: white;
        font-size: 20px;
        border-radius: 5px;
        direction: rtl;
    }
</style>
<?php
//add action
add_action('admin_menu', 'wp_apis_register_menus');
//functions
function wp_apis_register_menus()
{
    add_menu_page(
        'پلاگین API',
        'مدیریت اطلاعات',
        'manage_options',
        'wp_apis_admin',
        'wp_apis_main_menu_handler'


    );

    add_submenu_page(
        'wp_apis_admin',
        'مشاهده اخبار',
        'مشاهده اخبار',
        'manage_options',
        'wp_apis_general',
        'wp_apis_general_page'
    );

}

//end function wp_apis_register_menus
function wp_apis_main_menu_handler()
{
    global $wpdb;

    @$action = $_GET['action'];

    if ($action == "delete") {
        $item = intval($_GET['item']);
        if ($item > 0) {
            $wpdb->delete($wpdb->prefix . 'apinews', ['id' => $item]);
        }
    }
    if ($action == "add") {
        if (isset($_POST['saveData'])) {
            $wpdb->insert($wpdb->prefix . 'apinews', [
                'name_office' => $_POST['name_office'],
                'api_address' => $_POST['api_address'],
                'categories' => $_POST['categories'],
            ]);
        }
        include WP_APIS_TPL . 'admin/menus/add.php';
    } else {
        $samples = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}apinews");
        $apipost = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}apipost");

        include WP_APIS_TPL . 'admin/menus/main.php';
    }


}

function wp_apis_general_page()
{
    if (isset($_POST['savesettings'])) {
        if (isset($_POST['is_plugin_active'])) {
            update_option('wp_apis_is_active', 1);
        } else {
            delete_option('wp_apis_is_active', 0);
        }

    }
    $current_plugin_status = get_option('wp_apis_is_option', 0);
    include WP_APIS_TPL . 'admin/menus/general.php';

}

function wp_apis_users_page()
{
    global $wpdb;
    if (isset($_GET['action']) && $_GET['action'] == 'edit')
    {
        $userID = intval($_GET['id']);
        if(isset($_POST['saveOfficeInfo']))
        {
            $office = $_POST['name_office'];
            $apiadd = $_POST['api_adress'];
            if(!empty($office))
            {
                update_user_meta($userID,'name_office',$office);
            }
            if(!empty($apiadd))
            {
                update_user_meta($userID,'api_adress',$apiadd);
            }

        }


        $office = get_user_meta($userID,'name_office',true);
        $apiadd = get_user_meta($userID,'api_adress',true);
        include WP_APIS_TPL . 'admin/menus/edit.php';
        return;

    }


}
?>
//new code
