<?php

namespace ElementalMembership\Widgets\ProfileContent;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Profile_Content extends Widget_Base{

    public function get_name(){
        return 'em-profile-content';
    }

    public function get_title(){
        return __('Profile Content', 'elemental-membership');
    }

    public function get_icon(){
        return 'icon-em-profile-content';
    }

    public function get_categories(){
        return ['elemental-membership-category'];
    }

    public function get_keywords() {
		return [ 'content' ];
	}

    protected function register_controls(){

    }

    protected function render(){

    }

    protected function content_template(){
        
    }

}