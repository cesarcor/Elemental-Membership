<?php

namespace ElementalMembership\Widgets\Forms;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use ElementalMembership\Includes\Core\Profile;

class Edit_Profile_Form extends Widget_Base {
    public function get_name() {
        return 'profile-edit-form';
    }

    public function get_title() {
        return __('Edit Profile Form');
    }

    public function get_icon() {
        return '';
    }

    public function get_categories() {
        return ['elemental-membership-category'];
    }

    protected function register_controls() {
        $repeater = new Repeater();

        $em_field_widths = [
            '' => __('Default', 'elemental-membership'),
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
            'nickname' => __('Nickname', 'elemental-memebership'),
            'user_email' => __('User Email', 'elemental-memebership'),
            'first_name' => __('First Name', 'elemental-membership'),
            'last_name' => __('Last Name', 'elemental-membership'),
            'user_bio' => __('User Bio/Description', 'elemental-membership')
        ];
        
        $this->start_controls_section(
            'fields_section',
            [
                'label' => __('Fields', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater->add_control(
            'em_field_type',
            [
                'label' => __('Field Type', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'first_name',
                'options' => $em_field_type
            ]
        );

        $repeater->add_control(
            'em_field_label',
            [
                'label' => __('Field Label', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $repeater->add_control(
            'em_field_placeholder',
            [
                'label' => __('Field Placeholder', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
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

        $this->add_control(
            'em_field_list',
            [
                'label' => __('Field List', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'em_field_label' => __('Nickname', 'elemental-membership'),
                        'em_field_placeholder' => 'jondoe',
                        'em_field_type' => 'nickname'
                    ],

                    [
                        'em_field_label' => __('Email', 'elemental-membership'),
                        'em_field_placeholder' => 'jondoe@mail.com',
                        'em_field_type' => 'user_email'
                    ],

                    [
                        'em_field_label' => __('Bio/Description', 'elemental-membership'),
                        'em_field_placeholder' => __('Add description...', 'elemental-membership'),
                        'em_field_type' => 'user_bio'
                    ],

                ],

                'title_field' => '{{{ em_field_label }}}',
            ]
        );

        $this->add_control(
            'show_labels',
            [
                'label' => __('Show Label', 'elemental-membership'),
                'separator' => 'before',
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => __('Submit Button', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Submit',
                'placeholder' => ''
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => __('Size', 'elemental-membership'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'xs' => __('Extra Small', 'elemental-membership'),
                    'sm' => __('Small', 'elemental-membership'),
                    'md' => __('Medium', 'elemental-membership'),
                    'lg' => __('Large', 'elemental-membership'),
                    'xl' => __('Extra Large', 'elemental-membership'),
                ],
                'default' => 'sm',
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
            'align',
            [
                'label' => __('Alignment', 'elemental-membership'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __('Left', 'elemental-membership'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elemental-membership'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => __('Right', 'elemental-membership'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'stretch' => [
                        'title' => __('Justified', 'elemental-membership'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'prefix_class' => 'elementor%s-button-align-',
                'default' => '',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'user_logged_out_section',
            [
                'label' => __('Logged Out Users', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'form_view',
            [
                'label' => __('View As', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'logged_in_view' => 'User is logged in',
                    'not_logged_in_view' => 'User is logged out'
                ],
                'default' => 'logged_in_view'
            ]
        );

        $this->add_control(
            'logged_out_user_text',
            [
                'label' => __('Logged Out User Text', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __('You must be logged in to edit', 'elemental-membership')
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_form_style',
            [
                'label' => __('Form', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'row_gap',
            [
                'label' => __('Rows Gap', 'elemental-membership'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '10',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-field-group' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_form_label_style',
            [
                'label' => __('Label', 'elemental-membership'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_labels!' => '',
                ],
            ]
        );

        $this->add_control(
            'label_spacing',
            [
                'label' => __('Spacing', 'elemental-membership'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '0',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    'body {{WRAPPER}} .elementor-field-group > label' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                    // for the label position = above option
                ],
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => __('Text Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-field-group label' => 'color: {{VALUE}};',
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
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .elementor-field-group label',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_form_field_style',
            [
                'label' => __('Fields', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label' => __('Text Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-field-group .elementor-field' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .elementor-field-group .elementor-field, {{WRAPPER}} .elementor-field-subgroup label',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            'field_background_color',
            [
                'label' => __('Background Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .elementor-field-group .elementor-field:not(.elementor-select-wrapper)' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'field_border_color',
            [
                'label' => __('Border Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-field-group .elementor-field:not(.elementor-select-wrapper)' => 'border-color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'field_border_width',
            [
                'label' => __('Border Width', 'elemental-membership'),
                'type' => Controls_Manager::DIMENSIONS,
                'placeholder' => '1',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-field-group .elementor-field:not(.elementor-select-wrapper)' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'field_border_radius',
            [
                'label' => __('Border Radius', 'elemental-membership'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-field-group .elementor-field:not(.elementor-select-wrapper)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_form_button_style',
            [
                'label' => __('Button', 'elemental-membership'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'elemental-membership'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .em-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .em-button',
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __('Background Color', 'elemental-membership'),
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

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .em-button',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'elemental-membership'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .em-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_padding',
            [
                'label' => __('Text Padding', 'elemental-membership'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .em-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __('Hover', 'elemental-membership'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Text Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label' => __('Background Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __('Border Color', 'elemental-membership'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .em-button:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_border_border!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => __('Animation', 'elemental-membership'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        if ($this->em_user_is_in_editor()){
            $this->render_user_loggedout_message(); 
		} else{
            $this->render_form();
        }
    }

    /**
     *
     * Renders edit profile form
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render_form() {
        $settings = $this->get_settings_for_display();
        $buttonWidth = (('' !== $settings['em_button_width']) ? $settings['em_button_width'] : '100');

        if (Plugin::$instance->documents->get_current()){
            $this->page_id = Plugin::$instance->documents->get_current()->get_main_id();
        } ?>

		<form class="em-form em-edit-profile-form">

            <?php $this->render_form_fields(); ?>

            <div class="elementor-field-group elementor-field-type-submit elementor-column elementor-col-<?php echo $buttonWidth; ?>">
                <button type="submit" class="em-button elementor-button elementor-size-<?php echo $settings['button_size']; ?>">
                    <?php echo $settings['button_text']; ?>
                </button>
            </div>

            <div class="em-form-error elementor-field-group"></div>
            <div class="em-form-success elementor-field-group"></div>

            <input type="hidden" name="action" value="em_edit_profile_info_change" />
            <?php wp_nonce_field('em_edit_profile_info_change', 'em_profile_info_change_nonce'); ?>
            <input type="hidden" name="page_id" value="<?php echo esc_attr($this->page_id); ?>">
            <input type="hidden" name="widget_id" value="<?php echo esc_attr($this->get_id()); ?>">

		</form>


	<?php
    }

    /**
     *
     * Renders form fields based on Elementor's repeater control
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render_form_fields(){
        $settings = $this->get_settings_for_display();
        $user_profile = new Profile();
        $user_first_name = $user_profile->get_user_first_name();
        $user_last_name = $user_profile->get_user_last_name();
        $user_nickname = $user_profile->em_get_user_nickname();
        $user_email = $user_profile->em_get_user_email();
        $user_bio = $user_profile->em_get_user_bio();

        foreach ($settings['em_field_list'] as $item_index => $item){
        
            $fieldWidth = (('' !== $item['em_field_width']) ? $item['em_field_width'] : '100');
            $field_value = '';
            
            ?>
                <div class="em-edit-profile-field elementor-field-group elementor-column elementor-col-<?php echo $fieldWidth; ?>">
                    <?php
                        if ($settings['show_labels']){
                            echo('<label for="' . str_replace(' ', '', $item['em_field_label']) . '">' . $item['em_field_label'] . '</label>');
                        }
                    ?>
                    <?php
                        switch($item['em_field_type']){
                            case 'first_name':
                                $field_value = $user_first_name;
                            break;
                            case 'last_name':
                                $field_value = $user_last_name;
                            break;
                            case 'nickname':
                                $field_value = $user_nickname;
                            break;
                            case 'user_email':
                                $field_value = $user_email;
                            break;
                            case 'user_bio':
                                $field_value = $user_bio;
                            break;
                            default:
                                $field_value = '';
                        }

                        switch($item['em_field_type']){
                            case 'nickname':
                            case 'first_name':
                            case 'last_name':
                                echo '
                                <input
                                type="text" 
                                name="form_fields[' . $item['em_field_type'] .  ']" 
                                id="' . esc_attr(str_replace(' ', '', $item['em_field_label']))  . '" 
                                placeholder="' . esc_attr($item['em_field_placeholder']) . '" 
                                value="'. $field_value .'"
                                >';
                            break;
                            case 'user_email':
                                echo '
                                <input 
                                type="email" 
                                name="form_fields[' . $item['em_field_type'] .  ']" 
                                id="' . esc_attr(str_replace(' ', '', $item['em_field_label']))  . '"
                                placeholder="' . esc_attr($item['em_field_placeholder']) . '"
                                value="' . $field_value . '"
                                >';
                            break;
                            case 'user_bio':
                                echo '
                                <textarea
                                name="form_fields[' . $item['em_field_type'] .  ']"
                                id="' . esc_attr(str_replace(' ', '', $item['em_field_label']))  . '"
                                placeholder="' . esc_attr($item['em_field_placeholder']) . '"
                                >' . $field_value .  '</textarea>';
                            break;
                        }

                    ?>
                </div>

        <?php }
    }

    /**
     *
     * Renders message if the user accessing form is logged out
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render_user_loggedout_message() {
        $settings = $this->get_settings_for_display(); ?>
		<div class="em-user-registered-msg">
			<?php echo $settings['logged_out_user_text']; ?>
		</div>

	<?php
    }

    /**
     *
     * Check if user is viewing the form in the Elementor editor
     *
     * @since 1.0.0
     * @access public
     */
    public function em_user_is_in_editor() {
        $settings = $this->get_settings_for_display();

        if ((is_user_logged_in() &&
        !\Elementor\Plugin::$instance->editor->is_edit_mode()) ||
        (is_user_logged_in() &&
        $settings['form_view'] == 'logged_in_view')){
            return; } else{
            return true;
        }
    }

    protected function content_template() {
        ?>

	<# if(settings.form_view == 'not_logged_in_view') { #>

	<div class="em-user-registered-msg">
		{{{ settings.logged_out_user_text }}}
	</div>

	<# } else { #>

		<div class="em-form">

            <# if(settings.em_field_list){ #>

            <div class="elementor-form-fields-wrapper elementor-labels-above">

            <#
                _.each( settings.em_field_list, function( item, index ) {

                    var fieldWidth = ( ( '' !== item.em_field_width ) ? item.em_field_width : '100' );

                #>

                <div class="em-user-registration-form__field em-form-field-group elementor-field-group elementor-column elementor-col-{{{ fieldWidth }}}">

                    <#
                    if(item.em_field_label && settings.show_labels){
                    #>

                        <label for="{{{ item.em_field_label }}}"> {{{item.em_field_label}}} </label>

                    <#
                    }
                    #>

                    <#

                    if(item.em_field_type){

                        switch(item.em_field_type){
                            case 'nickname':
                            case 'first_name':
                            case 'last_name':
                        #>
                            <input type="text" id="{{{ item.em_field_label }}}" class="em-form-field" placeholder="{{{ item.em_field_placeholder }}}">
                        
                        <# break;

                            case 'user_email':
                        #>
                            <input type="email" id="{{{ item.em_field_label }}}" class="em-form-field" placeholder="{{{ item.em_field_placeholder }}}">
                        <#
                            break;
                            case 'user_bio': 
                        #>

                            <textarea class="em-form-field em-textarea-field" placeholder="{{{ item.em_field_placeholder }}}"></textarea>
                    
                        <# 
                            break;
                        #>

                        <#
                        
                        }

                    } #>

                    </div>

                    <#

                }); #>

            </div>

            <# } #>

			<div class="elementor-field-group elementor-field-type-submit elementor-column elementor-col-{{{settings.em_button_width}}}">
				<button type="submit" class="em-button elementor-button elementor-size-{{ settings.button_size }}">
				 	{{{ settings.button_text }}}
				</button>
			</div>

		</div>

		<# } #>

	<?php
    }
}
