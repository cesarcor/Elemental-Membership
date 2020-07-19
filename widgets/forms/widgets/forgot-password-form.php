<?php

namespace ElementalMembership\Widgets\Forms;

use Elementor\Widget_Base;

class Forgot_Password_Form extends Widget_Base{

    public function get_name() {
        return 'forgot-password-form';
    }

	public function get_title() {
        return __('Forgot Password Form', 'elemental-membership');
    }

	public function get_icon() {
        return '';
    }

	public function get_categories() {
        return ['elemental-membership-category'];
    }

	protected function _register_controls() {}

	protected function render() {
    ?>

        <form class="elementor-form">
            <div class="elementor-form-fields-wrapper">
                <div class="elementor-field-group elementor-column elementor-col-100">
                    <label for="forgot-pw-email">Your Email</label>
                    <input type="email" id="forgot-pw-email" placeholder="Email"/>
                </div>

                <div>
                    <button type="submit" class="em-button elementor-button">
                        Submit
                    </button>
                </div>
            <div>
                    
                </div>
            </div>
        </form>

    <?php

    }

	protected function _content_template() {
    ?>

        <div class="elementor-form">

            <div class="elementor-form-fields-wrapper">
                <div class="elementor-field-group elementor-column elementor-col-100">
                    <label for="forgot-pw-email">Your Email</label>
                    <input type="email" id="forgot-pw-email" placeholder="Email"/>
                </div>
                
                <div>
                    <button type="submit" class="em-button elementor-button">
                        Submit
                    </button>
                </div>
            </div>
        
        </div>

        
    <?php
    }

}