<?php

class launch_Options {
	public static $settings = array();
	public static function init( $settings ) {
		self::$settings = $settings;
	}
	private static function get_control( $type ) {
		switch ($type) {
			case 'image' :
				$result = 'WP_Customize_Image_Control'; 
			break;
			case 'upload' :
				$result = 'WP_Customize_Upload_Control'; 
			break;
			case 'color' : 
				$result = 'WP_Customize_Color_Control'; 
			break;
			default:
				$result = 'WP_Customize_Control'; 
			break;
		}
		return $result;
	}
	public static function register ( $wp_customize ) {
		$section_default = array(
            'priority' => 35, //Determines what order this appears in
            'capability' => 'edit_theme_options', //Capability needed to tweak
		);
		$setting_default = array(
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'sanitize_callback' => 'sanitize_text_field',
		);
		$control_default = array(
            'priority' => 10, //Determines the order this control appears in for the specified section
		);
		foreach ( self::$settings as $section_id => $section ) {
			$section_args = wp_parse_args( $section, $section_default );
			$wp_customize->add_section( $section_id, $section_args );
			foreach ( $section['fields'] as $setting_id => $setting ) {
				$setting_args = wp_parse_args( $setting['setting'], $setting_default );
				$wp_customize->add_setting( $setting_id, $setting_args );
				$control_args = wp_parse_args( $setting['control'], $control_default );
				$control_args['section'] = $section_id;
				$control_args['settings'] = $setting_id;
				$control_args['type'] = $setting['type'];
				$control_class = self::get_control($setting['type']);
				$control_class = new $control_class(
					$wp_customize, 
					$setting_id,
					$control_args
				);
				$wp_customize->add_control( $control_class );
 			}
		}
	}

   	public static function header_output() {
		foreach ( self::$settings as $section_id => $section ) {
			foreach ( $section['fields'] as $setting_id => $setting ) {
				if ( isset( $setting['css'] ) && $setting['css'] && ( get_theme_mod( $setting_id ) || isset( $setting['setting']['default'] ) ) ) {
					$output[] = self::generate_css(
						$setting['css']['selector'],
						$setting['css']['style'],
						get_theme_mod( $setting_id ) ? get_theme_mod( $setting_id ) : $setting['setting']['default'],
						isset( $setting['css']['prefix'] ) ? $setting['css']['prefix'] : '',
						isset( $setting['css']['postfix'] ) ? $setting['css']['postfix'] : '',
						false
					);
				}
			}
		}
		if( $output ) {
			$output = implode( "\n\t\t\t", $output );
			echo "\t\t<style>\n\t\t\t{$output}\n\t\t</style>\n";
		}
	}
   
   public static function live_preview() {
      wp_enqueue_script( 
           'mytheme-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/assets/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );
   }

    private static function generate_css( $selector, $style, $value, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      if ( ! empty( $value ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$value.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

?>