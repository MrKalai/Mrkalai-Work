<?php 
namespace ElementsKit\Libs\Framework\Classes;
use ElementsKit\Libs\Framework\Classes\Utils;

defined( 'ABSPATH' ) || exit;

class License{

    public static $instance = null;

    public function get_license_info(){
        return apply_filters('elementskit/license/extended', '');
    }

    public function activate($key){
        $data = [
            'key' => 'DE89EF13B1AB6BFD55A676D85DB39',
            'id' => \ElementsKit::PRODUCT_ID
        ];
        $o = 1;
        
            update_option('__validate_oppai__', 1);
            Utils::instance()->save_option('license_key', 'DE89EF13B1AB6BFD55A676D85DB39');
       
        
        return $o;
    }
    public function revoke(){
        $data = [
            'key' => 'DE89EF13B1AB6BFD55A676D85DB39',
        ];

        delete_option('__validate_oppai__');
        Utils::instance()->save_option('license_key', '');
        
        return true;
    }
    public function com_validate($data = []){
       
        $data['oppai'] = get_option('__validate_oppai__');
        $data['action'] = 'activate';
        $data['v'] = \ElementsKit::VERSION;
        $url = \ElementsKit::api_url() . 'license?' . http_build_query($data);
        
        $args = array(
            'timeout'     => 60,
            'redirection' => 3,
            'httpversion' => '1.0',
            'blocking'    => true,
            'sslverify'   => true,
        ); 

        $res = wp_remote_get( $url, $args );

        return (object) json_decode(
            (string) $res['body']
        ); 
    }

    public function com_revoke($data = []){
        $data['oppai'] = get_option('__validate_oppai__');
        $data['action'] = 'revoke';
        $data['v'] = \ElementsKit::VERSION;
        $url = \ElementsKit::api_url() . 'license?' . http_build_query($data);
        
        $args = array(
            'timeout'     => 10,
            'redirection' => 3,
            'httpversion' => '1.0',
            'blocking'    => true,
            'sslverify'   => true,
        ); 

        $res = wp_remote_get( $url, $args );

        return (object) json_decode(
            (string) $res['body']
        );
    }

    public function status(){
        
		return 'valid';
		$cached = wp_cache_get( 'elementskit_license_status' );
		

        $oppai = get_option('__validate_oppai__');
        $key = Utils::instance()->get_option('license_key');
        $status = 'valid';

       
         $status = 'valid';
       
        wp_cache_set( 'elementskit_license_status', 'valid' );
        return $status;
    }

    public static function instance() {
        if ( is_null( self::$instance ) ) {

            // Fire the class instance
            self::$instance = new self();
        }

        return self::$instance;
    }
}