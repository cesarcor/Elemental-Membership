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

        foreach($_POST['login_fields'] as $field => $value):

            switch($field):
                case "user_login":
                    $user_login = $value;
                break;
                case "user_login_pwd":
                    $user_password = $value;
                break;
            endswitch;

            wp_signon(
                array(
                    'user_login' => $user_login,
                    'user_password' => $user_password,
                    'remember' => false
                ),
                false
            );
            
        endforeach;

    }
}