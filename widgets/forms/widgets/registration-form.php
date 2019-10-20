<?php
namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use ElementalMembership\Widgets\Forms\Classes\EM_Form_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Registration Form
 *
 * Elemental Membership widget for user registration
 *
 * @since 0.0.1
 */

class Registration_Form extends Widget_Base{

    public function get_name(){
        return 'registration-form';
    }

    public function get_title(){
        return __('User Registration Form', 'elemental-membership');
    }

    public function get_icon(){
        return 'fas fa-jedi';
    }

    public function get_categories(){
        return ['elemental-membership-category'];
    }

    protected function _register_controls()
    {
        $repeater = new Repeater();

        $em_field_types = [
            'text' => __('Text', 'elemental-membership'),
            'email' => __('Email', 'elemental-membership'),
            'password' => __('Password', 'elemental-membership'),
            'textarea' => __('Text Area', 'elemental-membership'),
            'tel' => __('Telephone', 'elemental-membership'),
            'checkbox' => __( 'Checkbox', 'elementor-pro' )
        ];

        $this->start_controls_section(
            'em_fields_section',
            [
                'label' => __( 'Fields', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater->add_control(
            'em_field_type',
            [
                'label' => __('Field Type', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'text',
                'options' => $em_field_types
            ]
        );

        $repeater->add_control(
            'em_field_label',
            [
                'label' => __( 'Field Label', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'fcd',
                'placeholder' => 'ds'
            ]
        );

        $repeater->add_control(
            'em_field_placeholder',
            [
                'label' => __( 'Field Placeholder', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => ''
            ]
        );

        $repeater->add_control(
            'em_field_required',
            [
                'label' => __('Required', 'elemental-membership'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => ''
            ]
        );

        $this->add_control(
            'em_field_list',
            [
                'label' => __('Field List', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'em_field_type' => 'email',
                        'em_field_label' => __('Your Email', 'elemental-membership'),
                        'em_field_placeholder' => 'jondoe@mail.com',
                        'em_field_required' => 'true'
                    ],

                    [
                        'em_field_type' => 'password',
                        'em_field_label' => __('Password', 'elemental-membership'),
                        'em_field_placeholder' => __('Type password', 'elemental-membership'),
                        'em_field_required' => 'true'
                    ],

                    [
                        'em_field_type' => 'password',
                        'em_field_label' => __('Confirm Password', 'elemental-membership'),
                        'em_field_placeholder' => __('Type password again', 'elemental-membership'),
                        'em_field_required' => 'true'
                    ]

                    ],

                'title_field' => '{{{ em_field_label }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render(){
        $settings = $this -> get_settings_for_display();
    ?>

        <form class="em-user-registration-form" method="post" >
            <?php foreach($settings['em_field_list'] as $item_index => $item): ?>


            <?php endforeach; ?>

            <button type="submit">
                    Register
            </button>

        </form>

    <?php

    }

    protected function _content_template(){
        ?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<?php
    }

}