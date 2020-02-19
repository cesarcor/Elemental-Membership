<?php

namespace ElementalMembership\Widgets\ProfileHeader;

use Elementor\Widget_Base;

class Profile_Header extends Widget_Base{

    public function get_name(){
        return 'em-profile-header';
    }

    public function get_title(){
        return __('EM Profile Header', 'elemental-membership');
    }

    public function get_icon(){
        return 'fa fa-form';
    }

    public function get_categories(){
        return ['elemental-membership-category'];
    }

    protected function _register_controls(){

    }

    protected function render(){

    }

    protected function _content_template(){
        
    }


}