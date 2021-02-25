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
        if(!check_ajax_referer('em_profile_info_change_nonce')):
            wp_die();
        endif;
        
        $post_var = $_POST['form_fields'];

        $first_name = $this->em_get_fields($post_var)['first_name'];
        $last_name = $this->em_get_fields($post_var)['last_name'];
        $nickname = $this->em_get_fields($post_var)['nickname'];
        $user_email = $this->em_get_fields($post_var)['user_email'];
        $user_bio = $this->em_get_fields($post_var)['user_bio'];

        if($this->em_confirm_field_change('first_name', $first_name)['first_name']):
            $this->em_change_first_name($first_name);
        endif;

        if($this->em_confirm_field_change('last_name', $last_name)['last_name']):
            $this->em_change_last_name($last_name);
        endif;

        if($this->em_confirm_field_change('nickname', $last_name)['nickname']):
            $this->em_change_nickname($nickname);
        endif;

        if($this->em_confirm_field_change('user_email', $user_email)['user_email']):
            $this->em_change_user_email($user_email);
        endif;

        if($this->em_confirm_field_change('user_bio', $user_bio)['user_bio']):
            $this->em_change_bio($user_bio);
        endif;
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

        if($field_key === 'first_name' && $field_value !==  get_user_meta($user->ID, 'first_name', true)):
            $field_change['first_name'] = true;
        endif;

        if($field_key === 'last_name' && $field_value !==  get_user_meta($user->ID, 'last_name', true)):
            $field_change['last_name'] = true;
        endif;

        if($field_key === 'nickname' && $field_value !== get_user_meta($user->ID, 'nickname', true)):
            $field_change['nickname'] = true;
        endif;

        if($field_key === 'user_email' && $field_value !== $user_info->user_email):
            $field_change['user_email'] = true;
        endif;

        if($field_key === 'user_bio' && $field_value !== get_user_meta($user->ID, 'description', true)):
            $field_change['user_bio'] = true;
        endif;

        return $field_change;
    }

    protected function em_get_fields($fields){

        $field_value = array();

        if(isset($fields)):

            foreach ($fields as $field => $value):
                
                switch($field):

                    case 'first_name':
                        $field_value['first_name'] = $value;
                    break;

                    case 'last_name':
                        $field_value['last_name'] = $value;
                    break;

                    case 'nickname':
                        $field_value['nickname'] = $value;
                    break;

                    case 'user_email':
                        $field_value['user_email'] = $value;
                    break;

                    case 'user_bio':
                        $field_value['user_bio'] = $value;
                    break;

                endswitch;
            
            endforeach;

            return $field_value;

        endif;

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
        wp_update_user(array('ID' => $user->ID, 'nickname' => $new_name));
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
        wp_update_user(array('ID' => $user->ID, 'user_email' => $new_email));
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
        update_user_meta($user->ID, 'description', $new_bio);
    }

}