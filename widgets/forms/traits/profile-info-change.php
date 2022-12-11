<?php
namespace ElementalMembership\Widgets\Forms\Traits;

trait Profile_Info_Change{
    public function ajax_em_edit_profile_info(){
        add_action('wp_ajax_em_edit_profile_info_change', array($this, 'em_edit_profile_info_change'));
        add_action('wp_ajax_nopriv_em_edit_profile_info_change', array($this, 'em_edit_profile_info_change'));
    }

    /**
     * edit profile info
     *
     * @since 1.0.0
     *
     */
    public function em_edit_profile_info_change(){

        $errors = array();

        if (!wp_verify_nonce($_POST['em_profile_info_change_nonce'], 'em_edit_profile_info_change')){
            $errors['invalid_nonce'] = __('Security token not valid, try refreshing', 'elemental-membership');
            wp_send_json_error($errors['invalid_nonce']);
            wp_die();
        }

        $post_var = array();

        if(isset($_POST['form_fields'])){
            $post_var = $_POST['form_fields'];
        }
        
        if(isset($post_var['first_name']) && $this->em_confirm_field_change('first_name', $post_var['first_name'])['first_name']){
            $this->em_change_first_name($post_var['first_name']);
        }

        if(isset($post_var['last_name']) && $this->em_confirm_field_change('last_name', $post_var['last_name'])['last_name']){
            $this->em_change_last_name($post_var['last_name']);
        }

        if(isset($post_var['nickname']) && $this->em_confirm_field_change('nickname', $post_var['nickname'])['nickname']){
            $this->em_change_nickname($post_var['nickname']);
        }

        if(isset($post_var['user_email']) && $this->em_confirm_field_change('user_email', $post_var['user_email'])['user_email']){
            $this->em_change_user_email($post_var['user_email']);
        }

        if(isset($post_var['user_bio']) && $this->em_confirm_field_change('user_bio', $post_var['user_bio'])['user_bio']){
            $this->em_change_bio($post_var['user_bio']);
        }
    }

    protected function em_confirm_field_change($field_key, $field_value){
        $user = wp_get_current_user();
        $user_info = get_userdata($user->ID);
        $field_change = array(
            'first_name' => false,
            'last_name' => false,
            'nickname' => false,
            'user_email' => false,
            'user_bio' => false
        );

        if($field_key === 'first_name' && $field_value !==  get_user_meta($user->ID, 'first_name', true)){
            $field_change['first_name'] = true;
        }

        if($field_key === 'last_name' && $field_value !==  get_user_meta($user->ID, 'last_name', true)){
            $field_change['last_name'] = true;
        }

        if($field_key === 'nickname' && $field_value !== get_user_meta($user->ID, 'nickname', true)){
            $field_change['nickname'] = true;
        }

        if($field_key === 'user_email' && $field_value !== $user_info->user_email){
            $field_change['user_email'] = true;
        }

        if($field_key === 'user_bio' && $field_value !== get_user_meta($user->ID, 'description', true)){
            $field_change['user_bio'] = true;
        }

        return $field_change;
    }

    /**
     * change user first name
     *
     * @since 1.0.0
     * 
     * @param string $new_name
     *
     */
    protected function em_change_first_name($new_name){
        $user = wp_get_current_user();
        $first_name = update_user_meta($user->ID, 'first_name', $new_name);
        if(is_wp_error($first_name)){
            wp_send_json_error($first_name->get_error_message());
            return;
        }
    }

    /**
     * change user last name
     *
     * @since 1.0.0
     * 
     * @param string $new_name
     *
     */
    protected function em_change_last_name($new_name){
        $user = wp_get_current_user();
        $last_name = update_user_meta($user->ID, 'last_name', $new_name);
        if(is_wp_error($last_name)){
            wp_send_json_error($last_name->get_error_message());
            return;
        }
    }

    /**
     * change user nickname
     *
     * @since 1.0.0
     * 
     * @param string $new_name
     *
     */
    protected function em_change_nickname($new_name){
        $user = wp_get_current_user();
        $nickname = wp_update_user(array('ID' => $user->ID, 'nickname' => $new_name));
        if(is_wp_error($nickname)){
            wp_send_json_error($nickname->get_error_message());
            return;
        }
    }

    /**
     * change user email
     *
     * @since 1.0.0
     * 
     * @param string $new_email
     *
     */
    protected function em_change_user_email($new_email){
        $user = wp_get_current_user();
        $email = wp_update_user(array('ID' => $user->ID, 'user_email' => $new_email));
        if(is_wp_error($email)){
            wp_send_json_error($email->get_error_message());
            return;
        }
    }

    /**
     * change user bio/description
     *
     * @since 1.0.0
     * 
     * @param string $new_bio
     *
     */
    protected function em_change_bio($new_bio){
        $user = wp_get_current_user();
        $bio = update_user_meta($user->ID, 'description', $new_bio);
        if(is_wp_error($bio)){
            wp_send_json_error($bio->get_error_message());
            return;
        }
    }

}