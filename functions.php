<?php

// Add scripts and stylesheets
function spirit_scripts() {
	wp_enqueue_style( 'foundation', get_template_directory_uri() . '/spirit-foundation/dist/assets/css/app.css', array(), '6.2.1' );
	wp_enqueue_script( 'jQuery', get_template_directory_uri() . '/spirit-foundation/bower_components/jquery/dist/jquery.js', array() );
	wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/spirit-foundation/bower_components/foundation-sites/dist/js/foundation.js', array() );
	wp_enqueue_script( 'spirit-js', get_template_directory_uri() . '/spirit-foundation/src/assets/js/app.js', array() );
}

add_action( 'wp_enqueue_scripts', 'spirit_scripts' );

// Add Google Fonts
function startwordpress_google_fonts() {
				wp_register_style('OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800');
				wp_enqueue_style( 'OpenSans');
		}

add_action('wp_print_styles', 'startwordpress_google_fonts');

// WordPress Titles
add_theme_support( 'title-tag' );

// Register navigation menus
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


// Custom settings
function custom_settings_add_menu() {
  add_menu_page( 'Custom Settings', 'Custom Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99);
}
add_action( 'admin_menu', 'custom_settings_add_menu' );


// Create Custom Global Settings
function custom_settings_page() { ?>
  <div class="wrap">
    <h1>Custom Settings</h1>
    <form method="post" action="options.php">
       <?php
           settings_fields('section');
           do_settings_sections('theme-options');      
           submit_button(); 
       ?>          
    </form>
  </div>
<?php }

// Twitter - This adds a Twitter Field to the custom settings menu in the WordPress Admin
function setting_twitter() { ?>
  <input type="text" name="twitter" id="twitter" value="<?php echo get_option('twitter'); ?>" />
<?php }


// Github - This adds a Github Field to the custom settings menu in the WordPress Admin
function setting_github() { ?>
  <input type="text" name="github" id="github" value="<?php echo get_option('github'); ?>" />
<?php }


// Facebook - This adds a Facebook Field to the custom settings menu in the WordPress Admin
function setting_facebook() { ?>
  <input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
<?php }


// This adds the logic behind the fields that appear in the custom settings menu! 
function custom_settings_page_setup() {
  add_settings_section('section', 'All Settings', null, 'theme-options');
    add_settings_field('twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section');
    add_settings_field('github', 'GitHub URL', 'setting_github', 'theme-options', 'section');
    add_settings_field('facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section');

  register_setting('section', 'twitter');
  register_setting('section', 'github');
  register_setting('section', 'facebook');
}
add_action( 'admin_init', 'custom_settings_page_setup' );


// Support Featured Images
add_theme_support( 'post-thumbnails' );


// Custom Post Type
function create_my_custom_post() {
	register_post_type('my-custom-post',
			array(
			'labels' => array(
					'name' => __('My Custom Post'),
					'singular_name' => __('My Custom Post'),
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array(
					'title',
					'editor',
					'thumbnail',
				  'custom-fields'
			)
	));
}
add_action('init', 'create_my_custom_post');

// Load up our awesome theme options
require_once ( get_template_directory() . '/theme-options.php' );

// Load the TGM Plugin Activator
require_once dirname( __FILE__ ) . '/extras/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'spirit_require_plugins' );
 
function spirit_require_plugins() {
 
    $plugins = array( 
    	array(
    		'name' => 'Advanced Custom Fields',
    		'slug' => 'advanced-custom-fields',
    		'source' => get_stylesheet_directory() . '/extras/plugins/advanced-custom-fields/advanced-custom-fields.4.4.7.zip', // The internal source of the plugin.
    		'required' => true, // This plugin is required, can be set to false
    		'version' => '4.4.6', // This determines the minimum version the user must use for the required plugin
    		'force_activation' =>  false,// This plugin is going to stay activated unless the user switches to another theme
    	),/* The array to install plugins */ 
      array(
        'name' => 'Advanced Custom Fields Options Page',
        'slug' => 'advanced-custom-fields-options-page',
        'source' => get_stylesheet_directory() . '/extras/plugins/advanced-custom-fields-options-page/acf-options-page.zip', // The internal source of the plugin.
        'required' => true, // This plugin is required, can be set to false
        'version' => '', // This determines the minimum version the user must use for the required plugin
        'force_activation' =>  false,// This plugin is going to stay activated unless the user switches to another theme
      )/* The array to install plugins */ 
    );
    
    $config = array(
    		'id' => 'spirit-tgmpa', // your unique TGMPA ID, This is necessary to avoid conflics with multiple instances of the tgm plugin found elsewhere
    		'default_path' => '', // the default path for plugins inside your theme. When you set this, you can just use the name of the ZIP file as the source parameter for your plugin.
    		'menu' => 'spirit-install-required-plugins', // the menu slug for the plugin install page
    		'has_notices' => true, // show admin notices
    		'dismissable' => false, // the notices are NOT dismissable, if set to true, the user can "dismiss" the notices.
    		'dismiss_msg' => 'This theme requires extra plugins for it to work properly!', // this message will be output at the top of the nav
    		'is_automatic' => true, // automatically activates plugins after installation
    		'message' => '<!--This comes from my theme!-->', // optional HTML to display before the plugins table.
    		'strings' => array() // The array of message strings that TGM Plugin Activation uses. You can set them as translatable strings, too. Check out the example.php file to see the full list of message strings.
    	); /* The array to configure TGM Plugin Activation */ 
 
    tgmpa( $plugins, $config );
 
}