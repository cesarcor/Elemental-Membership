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


}