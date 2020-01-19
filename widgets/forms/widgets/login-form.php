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

    protected function _register_controls(){

        $em_login_identifiers = [
            'username_email' => __('Username & Email', 'elemental-membership'),
            'username_only' => __('Username Only', 'elemental-membership'),
            'email_only' => __('Email Only', 'elemental-membership')
        ];

        $this->start_controls_section(
            'em_login_fields_section',
            [
                'label' => __( 'Fields', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'em_login_show_labels',
            [
                'label' => __('Show Label', 'elemental-membership'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => '',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_login_button_section',
            [
                'label' => __( 'Login Button', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'em_login_button_text',
            [
                'label' => __( 'Button Text', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Login',
                'placeholder' => ''
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'em_login_options_section',
            [
                'label' => __( 'Login Options', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'em_login_identifier_opt',
            [
                'label' => __('Login Identifier', 'elemental-membership'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'username_email',
                'options' => $em_login_identifiers
            ]
        );

        $this->add_control(
            'em_show_lost_pw_link',
            [
                'label' => __('Lost your Password?', 'elemental-membership'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'label_on' => __('Show', 'elemental-membership'),
                'label_off' => __('Hide', 'elemental-membership')
            ]
        );

        $this->end_controls_section();

    }

    protected function render(){
        $settings = $this -> get_settings_for_display();
    ?>

        <form class="em-user-login-form">
            
            <div class="em-user-login-form__field">
                <?php if($settings['em_login_show_labels']): ?>
                    <label>Username</label>
                <?php endif; ?>
                
                <input type="text" placeholder="Username"/>
            </div>

            <div class="em-user-login-form__field">
                <?php if($settings['em_login_show_labels']): ?>
                    <label>Password</label>
                <?php endif; ?>

                <input type="password" placeholder="password"/>
            </div>

            <div class="em-user-login-form__field">
                <label>
                    <input type="checkbox"/>
                    Remember Me
                </label>
            </div>

            <div class="em-user-login-form__button">
                <button type="submit">
                  <?php echo $settings['em_login_button_text']; ?>
                </button>
            </div>

            <div class="em-user-login-form__field">
                <a href="#">Lost your password?</a>
            </div>

        </form>

    <?php
    }

    protected function _content_template(){
    ?>

        <form class="em-user-login-form">

            <div class="em-user-login-form__field">
             <# 
                var login_id = '';
                
                switch(settings.em_login_identifier_opt){
                    case 'email_only':
                        login_id = 'Email Address';
                    break;
                    case 'username_only':
                        login_id = 'Username';
                    break;
                    default:
                        login_id = 'Username or Email Address';
                }
             #>
                <label for=""><# {{{ login_id }}} #></label> 
                <input type="text" placeholder="{{{ login_id }}}" class="em-form-field em-user-login"/>
            </div>

            <div class="em-user-login-form__field">
                <label for="">Password</label>
                <input type="password" placeholder="password" class="em-form-field em-user-login-pw"/>
            </div>

            <div class="em-user-login-form__field">
                <label for="">
                    <input type="checkbox" />
                    Remember Me
                </label>
            </div>

            <div class="em-user-login-form__button">
                <button type="submit">
                    {{{ settings.em_login_button_text }}}
                </button>
            </div>

            <# if(settings.em_show_lost_pw_link){ #>
                <div class="em-user-login-form__field">
                    <a href="#">Lost your password?</a>
                </div>
            <# } #>

        </form>

    <?php
    }

}