<?php
namespace ElementalMembership\Widgets\Forms\Classes;
// use ElementalMembership\Widgets\Forms\Classes;

class Register_User{

    public function __construct(){
        add_action('wp_ajax_em_register_user', [$this, 'em_register_user']);
        add_action('wp_ajax_nopriv_em_register_user', [$this, 'em_register_user']);
    }

    /**
	 * EM Validate Fields
	 *
	 * Register new user in Wordpress
	 *
	 * @since 1.0.0
	 * @access public
	 */

     protected function validate_fields($fields){}


     /**
	 * EM Register User
	 *
	 * Register new user in Wordpress
	 *
	 * @since 1.0.0
	 * @access public
	 */
    public function em_register_user(){

        if (!check_ajax_referer( 'em_reg_nonce' )):
            wp_die();
        endif;

        $user_login = '';
        $user_email = '';
        $user_password = '';
        $first_name = '';
        $last_name = '';
        $user_role = 'author';

        foreach($_POST['form_fields'] as $field => $value):

            switch($field):
                case "username":
                    $user_login = htmlspecialchars(stripslashes(trim($value)));
                break;
                case "user_password":
                    $user_password = htmlspecialchars(stripslashes(trim($value)));
                break;
                case "user_email":
                    $user_email = htmlspecialchars(stripslashes(trim($value)));
                break;
                case "first-name":
                    $first_name = htmlspecialchars(stripslashes(trim($value)));
                break;
                case "last-name":
                    $last_name = htmlspecialchars(stripslashes(trim($value)));
            endswitch;

        endforeach;


        if (isset($user_login) && isset($user_password) && isset($user_email)):

            $userdata = array(
                'user_login' => $user_login,
                'user_pass' => $user_password,
                'user_email' => $user_email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'role' => $user_role,
            );

            wp_insert_user($userdata);

        endif;

        wp_die();

    }

}