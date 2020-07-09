<?php
namespace ElementalMembership\Widgets\Forms\Classes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Login_User{

    public function __construct(){
        add_action('wp_ajax_em_login_user', [$this, 'em_login_user']);
        add_action('wp_ajax_nopriv_em_login_user', [$this, 'em_login_user']);
    }

    public function em_login_user(){   

        $user_login;
        $user_password;
        $remember_me;

        foreach($_POST['login_fields'] as $field => $value):

            switch($field):
                case "user_login":
                    $user_login = $value;
                break;
                case "user_login_pwd":
                    $user_password = $value;
                case "user_remember_me":
                    $remember_me = $value == 'yes' ? true : false;
                break;
            endswitch;
            
        endforeach;

        $user_login = wp_signon(
            array(
                'user_login' => $user_login,
                'user_password' => $user_password,
                'remember' => $remember_me
            ),
            false
        );

        if(!is_wp_error($user_login)):
            wp_redirect(home_url());
            exit();
        endif;

    }
}