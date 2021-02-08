<?php
namespace ElementalMembership\Widgets\Forms\Classes;

class Change_Password{

    public function change_password($user_id, $current_password, $new_password, $new_password_confirm){

        $user = get_user_by('id', $user_id);

        if( $user && wp_check_password($current_password, $user->data->user_pass, $user_id)):
            wp_set_password($new_password, $user_id);
        else:
            echo __("Old password not correct", "elemental-membership");
        endif;
        
        wp_die();

    }

}