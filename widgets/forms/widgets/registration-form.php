<?php
namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use ElementalMembership\Widgets\Forms\Classes\Field_Creation;
use ElementalMembership\Widgets\Forms\Classes\Form_Options_Manager;

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
                '' => __( 'Default', 'elemental-membership' ),
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

        $em_user_roles = [
            'subscriber' => __('Subscriber', 'elemental-membership'),
            'contributor' => __('Contributor', 'elemental-membership'),
            'author' => __('Author', 'elemental-membership'),
            'editor' => __('Editor', 'elemental-membership'),
            'administrator' => __('Administrator', 'elemental-membership'),
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
            'em_registration_options_section',
            [
                'label' => __( 'Registration Options', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'em_user_role',
            [
                'label' => __('User Role', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'subscriber',
                'options' => $em_user_roles
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

        $this->add_control(
			'em_row_gap',
			[
				'label' => __( 'Rows Gap', 'elemental-membership' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .em-form-field-group' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this-> end_controls_section();

        $this->start_controls_section(
            'em_registration_form_field_style',
            [
                'label' => __( 'Fields', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'field_text_color',
			[
				'label' => __( 'Text Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-form-field-group .em-form-field' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
        );
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'field_typography',
				'selector' => '{{WRAPPER}} .em-form-field-group .em-form-field, {{WRAPPER}} .em-form-field-group label',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);

        $this-> end_controls_section();

        
        $this->start_controls_section(
            'em_registration_form_button_style',
            [
                'label' => __( 'Button', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'elemental-membership' ),
			]
        );

        $this->add_control(
			'em_button_background_color',
			[
				'label' => __( 'Background Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .em-button' => 'background-color: {{VALUE}};',
				],
			]
        );
        
        $this->add_control(
			'em_button_text_color',
			[
				'label' => __( 'Text Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .em-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .em-button svg' => 'fill: {{VALUE}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'em_button_typography',
				'scheme' => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .em-button',
			]
        );
        
        $this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .em-button',
			]
        );
        
        $this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .em-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'elemental-membership' ),
			]
        );

        $this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-button:hover' => 'background-color: {{VALUE}};',
				],
			]
        );
        
        $this->add_control(
			'button_hover_color',
			[
				'label' => __( 'Text Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-buttom:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this-> end_controls_section();

    }

    protected function render(){
        $settings = $this -> get_settings_for_display();
    ?>

        <form class="em-user-registration-form" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data">
            <?php $field_creation = new Field_Creation(); ?>

            <?php foreach($settings['em_field_list'] as $item_index => $item): ?>

            <div class="em-user-registration-form__field em-form-field-group">

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
            <?php wp_nonce_field( 'em_reg_nonce' ); ?>

            <div class="em-user-registration-form__button">
                <button type="submit" class="em-button">
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

                        <div class="em-user-registration-form__field em-form-field-group">

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
                    <button type="submit" class="em-button">
                        {{{ settings.em_submit_button_text }}}
                    </button>
                </div>

            </form>
		<?php
    }

}