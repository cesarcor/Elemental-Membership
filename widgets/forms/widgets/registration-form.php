<?php
namespace ElementalMembership\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

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
        return ['general'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'elemental-membership' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'important_note',
            [
                'label' => __( 'Important Note', 'elemental-membership' ),
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __('The forms contetn', 'elemental-membership'),
                'content_classes' => 'reg-form',
            ]
        );

        $this->end_controls_section();

    }

    protected function render(){
        $settings = $this -> get_settings_for_display();

        echo '<div class="title">';
		echo $settings['title'];
		echo '</div>'; 
    }

    protected function _content_template(){
        ?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<?php
    }

}