<?php
namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use ElementalMembership\Widgets\Forms\Classes\Field_Creation;

//For now...
include plugin_dir_path( __DIR__ ) . 'classes/field-creation.php';

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
            'date' => __('Date', 'elemental-membership'),
            'tel' => __('Telephone', 'elemental-membership'),
            'checkbox' => __( 'Checkbox', 'elementor-pro' )
        ];

        $em_field_widths = [
                '' => __( 'Default', 'elementor-pro' ),
                '100' => '100%',
                '80' => '80%',
                '75' => '75%',
                '66' => '66%',
                '60' => '60%',
                '50' => '50%',
                '40' => '40%',
                '33' => '33%',
                '25' => '25%',
                '20' => '20%',
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
                'default' => ''
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

        $repeater->add_control(
            'em_field_width',
            [
                'label' => __('Field Width', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'text',
                'options' => $em_field_widths
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
            <?php $field_creation = new Field_Creation(); ?>

            <?php foreach($settings['em_field_list'] as $item_index => $item): ?>

            <div class="em-user-registration-form__field">

            <?php 

                echo('<label>'. $item['em_field_label'] .'</label>');

                switch($item['em_field_type']):
                    case "text":
                    case "email":
                    case "password":
                    case "tel":
                    case "date":
                        $field_creation->create_input_field($item['em_field_label'], $item['em_field_type'], $item['em_field_placeholder']);
                    break;
                    case "textarea":
                        $field_creation->create_textarea_field();
                    break;
                    case "checkbox":
                        $field_creation->create_checkbox_field();
                    break;
                endswitch;
            
            ?>

            </div>

            <?php endforeach; ?>

            <div class="em-user-registration-form__button">
                <button type="submit">
                        Register
                </button>
            </div>

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