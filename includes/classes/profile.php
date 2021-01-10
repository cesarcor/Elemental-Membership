<?php

namespace ElementalMembership\Includes\Classes;

/**
 * Profile related functionality
 *
 * This class defines all code necessary for profile related functionality
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

        if(\Elementor\Plugin::$instance->editor->is_edit_mode()):
            $user_id = get_current_user_id();
        else:
            $uri = rtrim($_SERVER['REQUEST_URI'], '/');
            $user_uri = explode('/', $uri);
            $user_login = end($user_uri);
            $user = get_user_by('login', $user_login);
            $user_id = $user->ID;    
        endif;

        return $user_id;
    }

    /**
     * Get user's first name
     *
     * @since 1.0.0
     */
    public function get_user_first_name() {
        $first_name = get_user_meta($this->get_user(), 'first_name', true);

        return $first_name;
    }

    /**
     * Get user's last name
     *
     * @since 1.0.0
     */
    public function get_user_last_name() {
        $last_name = get_user_meta($this->get_user(), 'last_name', true);

        return $last_name;
    }

    /**
     * Get user's full name
     *
     * @since 1.0.0
     */
    public function get_user_full_name() {
        $full_name = $this->get_user_first_name() . ' ' . $this->get_user_last_name();

        return $full_name;
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
