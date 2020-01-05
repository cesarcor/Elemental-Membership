<?php
namespace ElementalMembership\Widgets\Forms\Classes;

class Register_User{

    public function __construct(){
        add_action('wp_ajax_em_register_user', [$this, 'em_register_user']);
        add_action('wp_ajax_nopriv_em_register_user', [$this, 'em_register_user']);
    }


     /**
	 * EM Register USer
	 *
	 * Register new user in Wordpress
	 *
	 * @since 1.0.0
	 * @access public
	 */
    public function em_register_user(){

        $user_login = '';
        $user_email = '';
        $user_password = '';

        foreach($_POST['form_fields'] as $field => $value):

            if($field == "username"):
                $user_login = $value;
            endif;

            if($field == "user_password"):
                $user_password = $value;
            endif;

            if($field == "user_email"):
                $user_email = $value;
            endif;

        endforeach;


        if (isset($user_login) && isset($user_password) && isset($user_email)):

            $userdata = array(
                'user_login' => $user_login,
                'user_pass' => $user_password,
                'user_email' => $user_email,
            );

            wp_insert_user($userdata);

        endif;

        wp_die();

    }

}

new Register_User();
