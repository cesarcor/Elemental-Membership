<?php
namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use ElementalMembership\Widgets\Forms\Classes\Field_Creation;
use ElementalMembership\Widgets\Forms\Actions\Register_User;

//For now...
include plugin_dir_path( __DIR__ ) . 'classes/field-creation.php';
// include plugin_dir_path( __DIR__ ) . 'classes/register-user.php';


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
        return 'em-registration-form';
    }

    public function get_title(){
        return __('User Registration Form', 'elemental-membership');
    }

    public function get_icon(){
        return 'em-registration-icon';
    }

    public function get_categories(){
        return ['elemental-membership-category'];
    }

    protected function _register_controls()
    {
        $repeater = new Repeater();

        $em_field_types = [
            'email' => __('Email', 'elemental-membership'),
            'password' => __('Password', 'elemental-membership'),
            'text' => __('Text', 'elemental-membership'),
            'textarea' => __('Textarea', 'elemental-membership'),
            'date' => __('Date', 'elemental-membership'),
            'tel' => __('Telephone', 'elemental-membership'),
            'checkbox' => __('Checkbox', 'elemental-membership'),
            'select' => __('Select', 'elemental-membership')
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

        $em_field_role = [
            'username' => __( 'Username', 'elemental-memebership' ),
            'user_email' => __( 'User Email', 'elemental-memebership' ),
            'user_password' => __( 'User Password', 'elemental-memebership' ),
            'user_password_confirm' => __( 'Password Confirmation', 'elemental-memebership' ),
            'custom_field' => __('Custom Field', 'elemental-membership'),
        ];

        $control_exceptions = [
            'terms' => [
                [
                    'name' => 'em_field_type',
                    'operator' => '!in',
                    'value' => [
                        'checkbox',
                        'select'
                    ]
                ]
            ]
        ];

        $fields_with_options = [
            'terms' => [
                [
                    'name' => 'em_field_type',
                    'operator' => 'in',
                    'value' => [
                        'checkbox',
                        'select'
                    ]
                ]
            ]
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
            'em_field_role',
            [
                'label' => __('Field Role', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'custom_field',
                'options' => $em_field_role
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
                'conditions' => $control_exceptions
            ]
        );

        $repeater->add_control(
            'em_field_required',
            [
                'label' => __('Required', 'elemental-membership'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => '',
                'conditions' => $control_exceptions
            ]
        );

        $repeater->add_control(
            'em_field_width',
            [
                'label' => __('Field Width', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'text',
                'options' => $em_field_widths,
                'conditions' => $control_exceptions
            ]
        );

        $repeater->add_control(
            'em_field_options',
            [
                'label' => __('Options', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '',
                'conditions' => $fields_with_options
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
                        'em_field_type' => 'text',
                        'em_field_label' => __('Username', 'elemental-membership'),
                        'em_field_placeholder' => 'jondoe',
                        'em_field_required' => 'true',
                        'em_field_role' => 'username'
                    ],

                    [
                        'em_field_type' => 'email',
                        'em_field_label' => __('Your Email', 'elemental-membership'),
                        'em_field_placeholder' => 'jondoe@mail.com',
                        'em_field_required' => 'true',
                        'em_field_role' => 'user_email'
                    ],

                    [
                        'em_field_type' => 'password',
                        'em_field_label' => __('Password', 'elemental-membership'),
                        'em_field_placeholder' => __('Type password', 'elemental-membership'),
                        'em_field_required' => 'true',
                        'em_field_role' => 'user_password'
                    ],

                    [
                        'em_field_type' => 'password',
                        'em_field_label' => __('Confirm Password', 'elemental-membership'),
                        'em_field_placeholder' => __('Type password again', 'elemental-membership'),
                        'em_field_required' => 'true',
                        'em_field_role' => 'user_password_confirm'
                    ]

                    ],

                'title_field' => '{{{ em_field_label }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_submit_button_section',
            [
                'label' => __( 'Submit Button', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'em_submit_button_text',
            [
                'label' => __( 'Button Text', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Register',
                'placeholder' => ''
            ]
        );

        $this->end_controls_section();
        

        $this->start_controls_section(
            'em_registration_form_style',
            [
                'label' => __( 'Registration Form Styles', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );



        $this-> end_controls_section();

    }

    protected function render(){
        $settings = $this -> get_settings_for_display();
    ?>

        <form class="em-user-registration-form" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data">
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
                        $field_creation->create_input_field(
                            $item['em_field_label'],
                            $item['em_field_type'],
                            $item['em_field_placeholder'],
                            $item['em_field_role']
                        );
                    break;
                    case "textarea":
                        $field_creation->create_textarea_field();
                    break;
                    case "checkbox":
                        $field_creation->create_checkbox_field();
                    case "select":
                        $field_creation->create_select_field($item['em_field_label'], $item['em_field_options']);
                    break;
                endswitch;
            ?>

            </div>

            <?php endforeach; ?>

            <input type="hidden" name="action" value="em_register_user" />

            <div class="em-user-registration-form__button">
                <button type="submit">
                  <?php echo $settings['em_submit_button_text']; ?>
                </button>
            </div>

        </form>

    <?php

    }

    protected function _content_template(){
        ?>
            <form class="em-user-registration-form">

                    <#

                    if(settings.em_field_list){
                        var count = 0;

                        _.each( settings.em_field_list, function( item, index ) {
                    #>

                        <div class="em-user-registration-form__field">

                    <#

                            count++;
                            #>

                            <#
                            if(item.em_field_label){
                            #>

                                <label for="em_field_{{{ count }}}"> {{{item.em_field_label}}} </label>

                            <#
                            }
                            #>

                            <#

                            if(item.em_field_type){

                                switch(item.em_field_type){
                                    case 'text':
                                    case 'password':
                                    case 'tel':
                                    case 'email':
                                #>
                                    <input type="{{{ item.em_field_type }}}" id="em_field_{{{ count }}}" class="em-form-field" placeholder="{{{ item.em_field_placeholder }}}">
                                
                                <# break;
                                    case 'textarea': 
                                #>

                                    <textarea class="em-form-field em-textarea-field" placeholder="{{{ item.em_field_placeholder }}}"></textarea>
                               
                                <# 
                                    break;
                                    case 'checkbox':
                                #>

                                    <input type="checkbox" />

                                <#
                                    break;
                                    case 'select':
                                #>

                                    <select class="em-form-field em-select-field">
                                    
                                        <#

                                            if(item.em_field_options){

                                            for(var x in item.em_field_options){

                                             '<option>' + item.em_field_options[x] + '</option>';

                                                }
                                        
                                            }

                                        #>
                                    
                                    </select>

                                <#
                                    break;
                                #>

                                <#
                                
                                }

                            } #>

                            </div>


                            <#

                        });
                    }
                    
                    #>

                <div class="em-user-registration-form__button">
                    <button type="submit">
                        {{{ settings.em_submit_button_text }}}
                    </button>
                </div>

            </form>
		<?php
    }

}