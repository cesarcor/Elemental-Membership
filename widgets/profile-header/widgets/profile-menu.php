<?php

namespace ElementalMembership\Widgets\ProfileHeader;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Profile_Menu extends Widget_Base{

    public function get_name(){
        return 'em-profile-menu';
    }

    public function get_title(){
        return __('Profile Menu', 'elemental-membership');
    }

    public function get_icon(){
        return '';
    }

    public function get_categories(){
        return ['elemental-membership-category'];
    }

    protected function _register_controls(){}
    protected function render(){}
    protected function _content_template(){}

}