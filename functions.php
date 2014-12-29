<?php 
  // TO DO - hook into theme customizer
  // TO DO - load options on init
  // TO DO - support the new title tag method for WP 4.1
  // TO DO - recognize/show moar social networks
  // TO DO - auto merge stylesheets, include logo/bg info on save.
  // TO DO - test mailchimp integration, integrate with wp-mailchimp(?)

  add_action( 'init', array( 'launch', 'init' ) );
  class launch {
    public static $options = array(
      'logo'            => '',
      'favicon'         => '',
      'name'            => false,
      'percent'         => 5,
      'mailchimp_user'  => '',
      'mailchimp_list'  => '',
      'mailchimp_after' => false,
    );
    public static function init() {
      global $content_width;
      self::init_options();
      add_action( 'wp_head', array( 'launch', 'head' ) );
      add_action( 'wp_enqueue_scripts', array( 'launch', 'styles' ) );
      add_action( 'wp_enqueue_scripts', array( 'launch', 'scripts' ) );
      register_nav_menu( 'social', __( 'Social links', 'launch' ) );
      require_once( 'includes/options.php' );
      self::init_settings();
      // Setup the Theme Customizer settings and controls...
      add_action( 'customize_register' , array( 'launch_Options' , 'register' ) );
      // Output custom CSS to live site
      add_action( 'wp_head' , array( 'launch_Options' , 'header_output' ) );
      // Enqueue live preview javascript in Theme Customizer admin screen
//      add_action( 'customize_preview_init' , array( 'launch_Options' , 'live_preview' ) );
      $args = array(
        'default-color' => '000000',
        'default-image' => '%1$s/assets/images/bg.jpg',
      );
      add_theme_support( 'custom-background', $args );
      add_theme_support( 'title-tag' );
      add_theme_support( 'automatic-feed-links' );
      if ( ! isset( $content_width ) ) $content_width = 500;
    }
    public static function init_settings() {
      $settings = array(
        'launch' => array(
          'title' => __( 'Launch Settings', 'launch' ),
          'description' => __( 'Basic theme settings', 'launch' ),
          'priority' => 31,
          'fields' => array(
            'percent' => array(
              'setting' => array(
                'default' => self::$options['percent'],
                'sanitize_callback' => 'intval',
              ),
              'control' => array(
                'label' => __( 'Percent completed', 'launch' ),
                'input_attrs' => array(
                  'min' => 0,
                  'max' => 100,
                  'step' => 1,
                ),
              ),
              'type' => 'number',
            ),
            'logo' => array(
              'setting' => array(
                'default' => self::$options['logo'],
              ),
              'control' => array(
                'label' => __( 'Logo', 'launch' ),
              ),
              'type' => 'image',
              'css' => array(
                'selector' => '#header .content span.logo',
                'style' => 'background-image',
                'prefix' => 'url(\'',
                'postfix' => '\')',
              ),
            ),
            'favicon' => array(
              'setting' => array(
                'default' => self::$options['favicon'],
              ),
              'control' => array(
                'label' => __( 'Favicon', 'launch' ),
              ),
              'type' => 'image',
            ),
          ),
        ),
        'mailchimp' => array(
          'title' => __( 'Mailchimp', 'launch' ),
          'description' => __( 'Mailchimp subscriptiion form', 'launch' ),
          'priority' => 33,
          'fields' => array(
            'mailchimp_user' => array(
              'setting' => array(
                'default' => self::$options['mailchimp_user'],
              ),
              'control' => array(
                'label' => __( 'Mailchimp User ID', 'launch' ),
              ),
              'type' => 'text',
            ),
            'mailchimp_list' => array(
              'setting' => array(
                'default' => self::$options['mailchimp_list'],
              ),
              'control' => array(
                'label' => __( 'Mailchimp List ID', 'launch' ),
              ),
              'type' => 'text',
            ),
            'mailchimp_after' => array(
              'setting' => array(
                'default' => self::$options['mailchimp_after'],
              ),
              'control' => array(
                'label' => __( 'Subscription success text', 'launch' ),
              ),
              'type' => 'text',
            ),
          ),
        ),
      );
      launch_Options::init( $settings );
    }
    public static function init_options() {
      if ( !self::$options['name'] ) {
        self::$options['name'] = __( 'The <strong>Launch</strong> Template', 'launch' );
      }
      if ( !self::$options['mailchimp_after'] ) {
        self::$options['mailchimp_after'] = __( 'Thanks for <strong>signing up</strong>. Check your email to <strong>confirm</strong> your subscription.', 'launch' );
      }      
      if ( !self::$options['logo'] ) {
        self::$options['logo'] = get_template_directory_uri().'/assets/images/logo.png';
      }
      if ( !self::$options['favicon'] ) {
        self::$options['favicon'] = get_template_directory_uri().'/assets/images/favicon.png';
      }
      $real_options = array();
      foreach(self::$options as $option_id => $value ) {
        $value = get_theme_mod($option_id);
        if ( $value ) {
          $real_options[$option_id] = $value;
        }
      }
//      self::$options = wp_parse_args( $real_options, self::$options );
      self::$options = apply_filters( 'launch_options', self::$options );
    }
    public static function strong_filter( $output ) {
      $output = preg_replace( '/\*\*(.+?)\*\*/ims', '<strong>$1</strong>', $output );
      return $output;
    }
    public static function scripts() {
      wp_register_script( 'launch-script', get_template_directory_uri().'/assets/scripts/main.js', array( 'jquery' ), false, true );
      wp_enqueue_script( 'launch-script' );
    }
    public static function styles() {
      wp_register_style( 'launch-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700' );
      wp_register_style( 'launch-style', get_bloginfo('template_url').'/style.css', array( 'launch-fonts' ) );
      wp_enqueue_style( 'launch-style' );
    }
    public static function head() {
      $tags = array(
//        'title'             => '<title>'.strip_tags( get_theme_mod( 'name' ) ).'</title>',
        'meta-charset'      => '<meta charset="'.esc_attr( get_bloginfo( 'charset' ) ).'">',
        'meta-ie-edge'      => '<meta http-equiv="X-UA-Compatible" content="IE=edge">',
        'meta-description'  => '<meta name="description" content="'.esc_attr( get_bloginfo( 'description' ) ).'">',
        'meta-viewport'     => '<meta name="viewport" content="width=device-width, initial-scale=1">',
        'favicon'           => '<link rel="shortcut icon" href="'.(get_theme_mod( 'favicon' )?get_theme_mod( 'favicon' ):self::$options['favicon']).'" type="image/x-icon" />',
      );
      $tags = apply_filters( 'launch_head', $tags );
      $result = implode( "\n\t\t", $tags );
      $result = "\t\t".$result."\n";
      echo $result;
    }

    private static function theme_compatibility_hack() {
      if ( is_singular() ) wp_enqueue_script( "comment-reply" );
      $args = array();
      wp_list_comments( $args );
      wp_link_pages( $args );
      comments_template( $file, $separate_comments );
      comment_form();
      paginate_links();
      paginate_comments_links();
      the_tags();
    }
  }

  class launch_walker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
      $output .= '';
    }
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
      $output .= "";
    }
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
      $classes = empty( $item->classes ) ? array() : (array) $item->classes;
      $classes[] = 'icon';
      if (preg_match('#^(https?:)?//github.com#', $item->url)) {
        $classes[] = 'github';
      }
      if (preg_match('#^(https?:)?//facebook.com#', $item->url)) {
        $classes[] = 'facebook';
      }
      if (preg_match('#^(https?:)?//twitter.com#', $item->url)) {
        $classes[] = 'twitter';
      }
      if (preg_match('#^mailto\:#', $item->url)) {
        $classes[] = 'email';
      }


      $atts = array();
      $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
      $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
      $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
      $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
      $atts['class']  = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
      $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

      $attributes = '';
      foreach ( $atts as $attr => $value ) {
        if ( ! empty( $value ) ) {
          $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
          $attributes .= ' ' . $attr . '="' . $value . '"';
        }
      }

      $item_output = $args->before;
      $item_output .= "\t\t\t\t\t";
      $item_output .= '<a'. $attributes .'>';
      /** This filter is documented in wp-includes/post-template.php */
      $item_output .= '</a>';
      $item_output .= "\n";
      $item_output .= $args->after;

      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
      $output .= '';
    }
  }

?>