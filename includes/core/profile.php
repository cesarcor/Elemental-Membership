<?php

namespace ElementalMembership\Includes\Core;

// Exit if accessed directly
if (!defined('ABSPATH')){
    exit;
}

/**
 * Profile & user related functionality
 *
 * This class defines all code necessary for profile and user related functionality
 *
 * @since      1.0.0
 * @author     Cesar Correchel <https://github.com/cesarcor>
 */
class Profile {

    /**
     * Get user's id
     *
     * @since 1.0.0
     */
    public function get_user() {
        $user_id;

        if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
            $user_id = get_current_user_id();
        } else{
            $uri = rtrim($_SERVER['REQUEST_URI'], '/');
            $user_uri = explode('/', $uri);
            $user_login = end($user_uri);
            $user = get_user_by('login', $user_login);
            $user_id = $user->ID;    
        }

        return $user_id;
    }

    /**
     * Get user's username
     *
     * @since 1.0.0
     */
    public function em_get_username() {
        $user_info = get_userdata($this->get_user());
        $username = $user_info->user_login;

        if(!$username){
            return esc_html('N/A');
        }

        return esc_html($username);
    }


    /**
     * Get user's first name
     *
     * @since 1.0.0
     */
    public function get_user_first_name() {
        $first_name = get_user_meta($this->get_user(), 'first_name', true);

        if(!$first_name || is_wp_error($first_name)){
            return false;
        }

        return esc_html($first_name);
    }

    /**
     * Get user's last name
     *
     * @since 1.0.0
     */
    public function get_user_last_name() {
        $last_name = get_user_meta($this->get_user(), 'last_name', true);

        if(!$last_name || is_wp_error($last_name)){
            return false;
        }

        return esc_html($last_name);
    }

    /**
     * Get user's full name
     *
     * @since 1.0.0
     */
    public function get_user_full_name() {
        $full_name = '';

        if($this->get_user_first_name() && $this->get_user_last_name()){
            $full_name = $this->get_user_first_name() . ' ' . $this->get_user_last_name();
            return esc_html($full_name);
        }

        return false;
    }

    /**
     * Get user's nickname
     *
     * @since 1.0.0
     */
    public function em_get_user_nickname(){
        $nickname = get_user_meta($this->get_user(), 'nickname', true);
        
        return esc_html($nickname);
    }

    /**
     * Get user's email
     *
     * @since 1.0.0
     */
    public function em_get_user_email() {
        $user_info = get_userdata($this->get_user());
        $user_email = $user_info->user_email;

        return esc_html($user_email);
    }

    /**
     * Get user's description
     *
     * @since 1.0.0
     */
    public function em_get_user_bio(){
        $user_description = get_user_meta($this->get_user(), 'description', true);

        return esc_html($user_description);
    }

    /**
     * rewrite profile page link
     *
     * @since 1.0.0
     */
    public function profile_url_rewrite() {
        $em_profile_link = '^profile/([^/]*)';
        add_rewrite_rule($em_profile_link, 'index.php?pagename=profile', 'top');
    }
}
