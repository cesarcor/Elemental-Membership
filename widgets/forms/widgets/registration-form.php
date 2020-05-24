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

        $em_field_type = [
            'username' => __( 'Username', 'elemental-memebership' ),
            'user_email' => __( 'User Email', 'elemental-memebership' ),
            'user_password' => __( 'User Password', 'elemental-memebership' ),
            'user_password_confirm' => __( 'Password Confirmation', 'elemental-memebership' ),
            'first_name' => __('First Name', 'elemental-membership'),
            'last_name' => __('Last Name', 'elemental-membership'),
            'description' => __('Description', 'elemental-membership'),
            'custom_field' => __('Custom Field', 'elemental-membership'),
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
                'default' => 'custom_field',
                'options' => $em_field_type
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
                'default' => ''
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
                'default' => '100',
                'options' => $em_field_widths
            ]
        );

        $repeater->add_control(
            'em_field_options',
            [
                'label' => __('Options', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
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
                        'em_field_label' => __('Username', 'elemental-membership'),
                        'em_field_placeholder' => 'jondoe',
                        'em_field_required' => 'true',
                        'em_field_type' => 'username'
                    ],

                    [
                        'em_field_label' => __('Your Email', 'elemental-membership'),
                        'em_field_placeholder' => 'jondoe@mail.com',
                        'em_field_required' => 'true',
                        'em_field_type' => 'user_email'
                    ],

                    [
                        'em_field_label' => __('Password', 'elemental-membership'),
                        'em_field_placeholder' => __('Type password', 'elemental-membership'),
                        'em_field_required' => 'true',
                        'em_field_type' => 'user_password'
                    ],

                    [
                        'em_field_label' => __('Confirm Password', 'elemental-membership'),
                        'em_field_placeholder' => __('Type password again', 'elemental-membership'),
                        'em_field_required' => 'true',
                        'em_field_type' => 'user_password_confirm'
                    ]

                    ],

                'title_field' => '{{{ em_field_label }}}',
            ]
        );


        $this->add_control(
			'show_labels',
			[
				'label' => __( 'Label', 'elemental-membership' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elemental-membership' ),
				'label_off' => __( 'Hide', 'elemental-membership' ),
				'return_value' => 'true',
				'default' => 'true',
				'separator' => 'before',
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

        $this->add_control(
			'user_requires_approval',
			[
				'label' => __( 'User Requires Approval', 'elemental-membership' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'elemental-membership' ),
				'label_off' => __( 'No', 'elemental-membership' ),
				'return_value' => 'yes',
				'default' => 'yes',
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

        $this->add_responsive_control(
            'em_button_width',
            [
                'label' => __('Column Width', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '100',
                'options' => $em_field_widths,
            ]
        );

        $this->add_responsive_control(
			'em_button_align',
			[
				'label' => __( 'Alignment', 'elemental-membership' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => __( 'Left', 'elemental-membership' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elemental-membership' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'elemental-membership' ),
						'icon' => 'eicon-text-align-right',
					],
					'stretch' => [
						'title' => __( 'Justified', 'elemental-membership' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'stretch',
				'prefix_class' => 'elementor%s-button-align-',
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
			'column_gap',
			[
				'label' => __( 'Columns Gap', 'elemental-membership' ),
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
					'{{WRAPPER}} .elementor-field-group' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .elementor-form-fields-wrapper' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
				],
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
				'label' => __( 'Text Color', 'elemental-membership' ),
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
        
        $this->add_control(
			'field_background_color',
			[
				'label' => __( 'Background Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .em-form-field' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
        );
        
        $this->add_control(
			'field_border_color',
			[
				'label' => __( 'Border Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-form-field-group .em-form-field' => 'border-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'field_border_width',
			[
				'label' => __( 'Border Width', 'elemental-membership' ),
				'type' => Controls_Manager::DIMENSIONS,
				'placeholder' => '1',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .em-form-field-group .em-form-field' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'field_border_radius',
			[
				'label' => __( 'Border Radius', 'elemental-membership' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .em-form-field-group .em-form-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'label' => __( 'Border Radius', 'elemental-membership' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .em-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_control(
			'button_text_padding',
			[
				'label' => __( 'Text Padding', 'elemental-membership' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .em-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' => __( 'Background Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-button:hover' => 'background-color: {{VALUE}};',
				],
			]
        );
        
        $this->add_control(
			'button_hover_color',
			[
				'label' => __( 'Text Color', 'elemental-membership' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .em-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this-> end_controls_section();

    }

    protected function render(){
        $settings = $this -> get_settings_for_display();
        $buttonWidth = ( ( '' !== $settings['em_button_width'] ) ? $settings['em_button_width'] : '100' );
        $input_type = '';
    ?>

        <form class="em-user-registration-form" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data">
            <?php $field_creation = new Field_Creation(); ?>

            <div class="elementor-form-fields-wrapper elementor-labels-above">

            <?php foreach($settings['em_field_list'] as $item_index => $item): ?>

            <?php 
                $fieldWidth = ( ( '' !== $item['em_field_width'] ) ? $item['em_field_width'] : '100' ); 
            ?>

            <div class="em-user-registration-form__field em-form-field-group elementor-field-group elementor-column elementor-col-<?php echo $fieldWidth; ?>">

            <?php 
                if($settings['show_labels']):
                    echo('<label for="'. $item['em_field_label'] .'">'. $item['em_field_label'] .'</label>');
                endif;

                switch($item['em_field_type']):
                    case "username":
                    case "first_name":
                    case "last_name":
                    case "user_password":
                    case "user_password_confirm":
                        $input_type = ($item['em_field_type'] == 'user_password' || $item['em_field_type'] == 'user_password_confirm') ? 'password' : 'text';

                        $field_creation->create_input_field(
                            $item['em_field_label'],
                            $item['em_field_label'],
                            $input_type,
                            $item['em_field_placeholder'],
                            $item['em_field_type'],
                            $item['em_field_required']
                        );
                    break;
                    case "user_email":
                        $field_creation->create_input_field(
                            $item['em_field_label'],
                            $item['em_field_label'],
                            "email",
                            $item['em_field_placeholder'],
                            $item['em_field_type'],
                            $item['em_field_required']
                        );
                    break;
                    case "description":
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

                <div class="elementor-field-group elementor-field-type-submit elementor-column elementor-col-<?php echo $buttonWidth; ?>">
                    <button type="submit" class="em-button elementor-button">
                    <span><?php echo $settings['em_submit_button_text']; ?></span>
                    </button>
                </div>

            </div>

            <input type="hidden" name="action" value="em_register_user" />
            <?php wp_nonce_field( 'em_reg_nonce' ); ?>

        </form>

    <?php

    }

    protected function _content_template(){

        ?>
            <form class="em-user-registration-form">

                    <#

                    if(settings.em_field_list){
                        var count = 0;
                        var buttonWidth = ( ( '' !== settings.em_button_width ) ? settings.em_button_width : '100' );
                        var inputType = '';

                    #>

                    <div class="elementor-form-fields-wrapper elementor-labels-above">

                    <#

                        _.each( settings.em_field_list, function( item, index ) {

                            var fieldWidth = ( ( '' !== item.em_field_width ) ? item.em_field_width : '100' );
                    #>
                        
                        <div class="em-user-registration-form__field em-form-field-group elementor-field-group elementor-column elementor-col-{{{ fieldWidth }}}">

                    <#

                            count++;
                            #>

                            <#
                            if(item.em_field_label && settings.show_labels){
                            #>

                                <label for="em_field_{{{ count }}}"> {{{item.em_field_label}}} </label>

                            <#
                            }
                            #>

                            <#

                            if(item.em_field_type){

                                switch(item.em_field_type){
                                    case 'username':
                                    case 'user_password':
                                    case 'user_password_confirm':
                                    case 'first_name':
                                    case 'last_name':

                                        inputType = (item.em_field_type == 'user_password' || item.em_field_type == 'user_password_confirm') ? 'password' : 'text';
                                #>
                                    <input type="{{{ inputType }}}" id="em_field_{{{ count }}}" class="em-form-field" placeholder="{{{ item.em_field_placeholder }}}">
                                
                                <# break;

                                    case 'user_email':
                                #>
                                     <input type="email" id="em_field_{{{ count }}}" class="em-form-field" placeholder="{{{ item.em_field_placeholder }}}">
                                <#
                                    break;
                                    case 'description': 
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

                        }); #>

                        <div class="elementor-field-group elementor-field-type-submit elementor-column elementor-col-{{{buttonWidth}}}">
                            <button type="submit" class="em-button">
                                <span>{{{ settings.em_submit_button_text }}}</span>
                            </button>
                        </div>

                        </div>

                    <#
                    }
                    
                    #>

            </form>
		<?php
    }

}