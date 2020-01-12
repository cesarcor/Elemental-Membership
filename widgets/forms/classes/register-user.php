<?php
namespace ElementalMembership\Widgets\Forms\Classes;
// use ElementalMembership\Widgets\Forms\Classes\Form_Options_Manager;

//For now...
// include_once(plugin_dir_path( __DIR__ ) . 'classes/form-options-manager.php');

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

     public function validate_fields(){

     }


     /**
	 * EM Register User
	 *
	 * Register new user in Wordpress
	 *
	 * @since 1.0.0
	 * @access public
	 */
    public function em_register_user(){

        // $form_opts = new Form_Options_Manager();

        $user_login = '';
        $user_email = '';
        $user_password = '';

        // $user_role = $form_opts->get_form_options();

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
                'role' => 'subscriber',
            );

            wp_insert_user($userdata);

        endif;

        wp_die();

    }

}