<?php 
namespace ElementsKit\Libs\Framework\Classes;

use ElementsKit\Libs\Framework\Classes\License;

defined( 'ABSPATH' ) || exit;

class Ajax{
    private $utils;

    public function __construct() {
        add_action( 'wp_ajax_ekit_admin_action', [$this, 'elementskit_admin_action'] );
        add_action( 'wp_ajax_ekit_admin_license', [$this, 'elementskit_admin_license'] );
        $this->utils = Utils::instance();
    }
    
    public function elementskit_admin_action() {

        if(!current_user_can('manage_options')){
            return;
        }


        $this->utils->save_option('widget_list', !isset($_POST['widget_list']) ? [] : $_POST['widget_list']);
        $this->utils->save_option('module_list',  !isset($_POST['module_list']) ? [] : $_POST['module_list']);
        $this->utils->save_option('user_data', $_POST['user_data']);

        wp_die(); // this is required to terminate immediately and return a proper response
    }

    public function elementskit_admin_license() {
        if(!current_user_can('manage_options')){
            return;
        }      
        $key = 'DE89EF13B1AB6BFD55A676D85DB39';
        $type2 = !isset($_GET['type']) ? '' : sanitize_text_field($_GET['type']);
        $type = !isset($_POST['type']) ? '' : sanitize_text_field($_POST['type']);
        $type = ($type == '') ? $type2 : $type;


        $result = [
            'status' => 'valid',
            'message' => esc_html__('Something went wrong', 'elementskit')
        ];

        switch($type){
            case 'activate':
               
        
                $o = License::instance()->activate( 'DE89EF13B1AB6BFD55A676D85DB39' );
               
                    $result = 1;
               
            
            break;
            case 'revoke':
                License::instance()->revoke();
                wp_redirect('https://account.wpmet.com/?page=products'); exit;
            break;
        }
        
        echo $this->return_json($result);
        wp_die();
    }

    public function return_json($data){
        if(is_array($data) || is_object($data)){
            return  json_encode($data);
        }else{
            return $data;
        }
    }

}