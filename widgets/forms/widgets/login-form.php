<?php
namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use ElementalMembership\Widgets\Forms\Classes\Field_Creation;

class Login_Form extends Widget_Base{

    public function get_name(){
        return 'em-login-form';
    }

    public function get_title(){
        return __('EM Login Form', 'elemental-membership');
    }

    public function get_icon(){
        return 'fa fa-form';
    }

    public function get_categories(){
        return ['elemental-membership-category'];
    }

}