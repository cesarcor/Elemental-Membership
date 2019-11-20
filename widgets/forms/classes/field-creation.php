<?php
namespace ElementalMembership\Widgets\Forms\Classes;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Field_Creation{

    function create_input_field($field_label, $field_type, $field_placeholder){

        $field_name = strtolower(preg_replace('/\s+/', '-', $field_label));

        echo '<input type="'. $field_type .'" class="em-form-field em-'. $field_name .'-field" placeholder="'. $field_placeholder .'" />';

    }

    function create_textarea_field(){
        echo '<textarea class="em-form-field" rows="4"></textarea>';
    }

    function create_checkbox_field(){
        echo '<input type="checkbox" value="Checkbox!" class="em-form-field"/>';
    }

    function create_select_field($field_label, $field_options){
        $options = preg_split( "/\\r\\n|\\r|\\n/", $field_options );

        if ( ! $options ) {
			return '';
		}

        echo '<select>';

        foreach($options as $option):
            $option_label = esc_html( $option );

            echo '<option>' . $option_label . '</option>';

        endforeach;
         
        echo '</select>';
    }


}