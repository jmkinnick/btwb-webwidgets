<?php
/*
Plugin Name: Beyond the Whiteboard
Plugin URI: http://www.beyondthewhiteboard.com/apps/wordpress
Version: 0.1
Author: Beyond the Whiteboard
Description: BTWB Integration for your Gym's Wordpress site.
License: GPLv2 or later
*/
/*  Copyright 2013  BadPopcorn, Inc  (email: contact@badpopcorn.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

///////////////////////////////////////////////////////////////////////////////
// JAVASCRIPT SDK INTEGRATION PARAMETERS
//
define('BTWB_JAVASCRIPT_SDK_URL',
  '//assets.beyondthewhiteboard.com/webwidgets/javascript/v1/btwb-webwidgets-reference.js');
  //'//assets.beyondthewhiteboard.com/webwidgets/javascript/v1/all.js');
define('BTWB_JAVASCRIPT_INIT_FILE', 'init.js');
define('BTWB_JAVASCRIPT_CONFIG_OBJECT_NAME', 'BTWB_CONFIG');
define('BTWB_JAVASCRIPT_API_KEY_PROPERTY', 'apiKey');


///////////////////////////////////////////////////////////////////////////////
// SETTINGS API AND WORDPRESS ADMIN PANEL
//

define('BTWB_OPTIONS', 'btwb_options');
define('BTWB', 'btwb');

// Hook in Btwb Plugin into the Admin settings menu.
add_action('admin_menu', 'btwb_admin_add_page');
function btwb_admin_add_page() {
  add_options_page(
    'Beyond the Whiteboard',
    'Btwb Options',
    'manage_options',
    BTWB,
    'btwb_plugin_options_page');
}

// Create the options page html.
function btwb_plugin_options_page() {
?>
<div>
<h2>Beyond the Whiteboard Options</h2>
<form action="options.php" method="post">
<?php settings_fields(BTWB_OPTIONS); ?>
<?php do_settings_sections(BTWB); ?> 
<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form>
</div>
<?
}

// Settings Sections
define('BTWB_S_GENERAL', 'btwb_section_general');
define('BTWB_S_WOD', 'btwb_section_wod');
define('BTWB_S_WOD_LIST', 'btwb_section_wod_list');
define('BTWB_S_ACTIVITIES', 'btwb_section_activities');
define('BTWB_S_LEADERBOARD', 'btwb_section_leaderboard');

// Defines Settings Keys inside wordpress, NOT params to btwb webwidgets
define('BTWB_SF_API_KEY', 'btwb_api_key');
define('BTWB_SF_WOD_SECTION', 'btwb_wod_section');
define('BTWB_SF_WOD_LEADERBOARD_LENGTH', 'btwb_wod_leaderboard_length');
define('BTWB_SF_WOD_ACTIVITIES_LENGTH', 'btwb_wod_activities_length');
define('BTWB_SF_WOD_LIST_DAYS_BACK', 'btwb_wod_list_days_back');
define('BTWB_SF_WOD_LIST_SECTION', 'btwb_wod_list_section');
define('BTWB_SF_WOD_LIST_LEADERBOARD_LENGTH', 'btwb_wod_list_leaderboard_length');
define('BTWB_SF_WOD_LIST_ACTIVITIES_LENGTH', 'btwb_wod_list_activities_length');
define('BTWB_SF_ACTIVITIES_LENGTH', 'btwb_activities_length');
define('BTWB_SF_LEADERBOARD_LENGTH', 'btwb_leaderboard_length');

// Settings Fields Value validation regular expressions.
$BTWB_SETTINGS_FIELD_VALIDATION_RULES = array(
  BTWB_SF_API_KEY => '/^[A-Za-z0-9]+$/i',
  BTWB_SF_WOD_SECTION => '/^[A-Za-z0-9]+$/i',
  BTWB_SF_WOD_LEADERBOARD_LENGTH => '/^[0-9]+$/i',
  BTWB_SF_WOD_ACTIVITIES_LENGTH => '/^[0-9]+$/i',
  BTWB_SF_WOD_LIST_DAYS_BACK => '/^[0-9]+$/i',
  BTWB_SF_WOD_LIST_SECTION => '/^[A-Za-z0-9]+$/i',
  BTWB_SF_WOD_LIST_LEADERBOARD_LENGTH => '/^[0-9]+$/i',
  BTWB_SF_WOD_LIST_ACTIVITIES_LENGTH => '/^[0-9]+$/i',
  BTWB_SF_ACTIVITIES_LENGTH => '/^[0-9]+$/i',
  BTWB_SF_LEADERBOARD_LENGTH => '/^[0-9]+$/i'
);

$BTWB_SETTINGS_FIELD_DEFAULTS = array(
  BTWB_SF_API_KEY => '',
  BTWB_SF_WOD_SECTION => '',
  BTWB_SF_WOD_LEADERBOARD_LENGTH => '3',
  BTWB_SF_WOD_ACTIVITIES_LENGTH => '0',
  BTWB_SF_WOD_LIST_DAYS_BACK => '7',
  BTWB_SF_WOD_LIST_SECTION => '',
  BTWB_SF_WOD_LIST_LEADERBOARD_LENGTH => '3',
  BTWB_SF_WOD_LIST_ACTIVITIES_LENGTH => '0',
  BTWB_SF_ACTIVITIES_LENGTH => '30',
  BTWB_SF_LEADERBOARD_LENGTH => '7'
);

// Registers our Settings Fields into the system
add_action('admin_init', 'btwb_admin_init');
function btwb_admin_init(){
  register_setting(
    BTWB_OPTIONS,
    BTWB_OPTIONS,
    'btwb_validate_options');

  // Sections
  add_settings_section(
    BTWB_S_GENERAL,
    'General Settings',
    'btwb_html_s_general',
    BTWB);
  add_settings_section(
    BTWB_S_WOD,
    '[wod] Shortcode',
    'btwb_html_s_wod',
    BTWB);
  add_settings_section(
    BTWB_S_WOD_LIST,
    '[wod_list] Shortcode',
    'btwb_html_s_wod_list',
    BTWB);
  add_settings_section(
    BTWB_S_ACTIVITIES,
    '[activities] Shortcode',
    'btwb_html_s_activities',
    BTWB);
  add_settings_section(
    BTWB_S_LEADERBOARD,
    '[leaderboard] Shortcode',
    'btwb_html_s_leaderboard',
    BTWB);

  // Settings Fields
  add_settings_field(
    BTWB_SF_API_KEY,
    'Web Widget Api Key',
    'btwb_html_sf_api_key',
    BTWB,
    BTWB_S_GENERAL);
  add_settings_field(
    BTWB_SF_WOD_SECTION,
    'Section (Pre, Main or Post)',
    'btwb_html_sf_wod_section',
    BTWB,
    BTWB_S_WOD);
  add_settings_field(
    BTWB_SF_WOD_LEADERBOARD_LENGTH,
    'Leaderboard Display Length',
    'btwb_html_sf_wod_leaderboard_length',
    BTWB,
    BTWB_S_WOD);
  add_settings_field(
    BTWB_SF_WOD_ACTIVITIES_LENGTH,
    'Results List Length',
    'btwb_html_sf_wod_activities_length',
    BTWB,
    BTWB_S_WOD);
  add_settings_field(
    BTWB_SF_WOD_LIST_DAYS_BACK,
    'Number of Days Back of Wods',
    'btwb_html_sf_wod_list_days_back',
    BTWB,
    BTWB_S_WOD_LIST);
  add_settings_field(
    BTWB_SF_WOD_LIST_SECTION,
    'Sections to Show',
    'btwb_html_sf_wod_list_section',
    BTWB,
    BTWB_S_WOD_LIST);
  add_settings_field(
    BTWB_SF_WOD_LIST_LEADERBOARD_LENGTH,
    'Leaderboard Display Length',
    'btwb_html_sf_wod_list_leaderboard_length',
    BTWB,
    BTWB_S_WOD_LIST);
  add_settings_field(
    BTWB_SF_WOD_LIST_ACTIVITIES_LENGTH,
    'Activity List Length',
    'btwb_html_sf_wod_list_activities_length',
    BTWB,
    BTWB_S_WOD_LIST);
  add_settings_field(
    BTWB_SF_ACTIVITIES_LENGTH,
    'Activity List Length',
    'btwb_html_sf_activities_length',
    BTWB,
    BTWB_S_ACTIVITIES);
  add_settings_field(
    BTWB_SF_LEADERBOARD_LENGTH,
    'Leaderboard Display Length',
    'btwb_html_sf_leaderboard_length',
    BTWB,
    BTWB_S_LEADERBOARD);
}


////
// Validates the entirety of the plugin's settings.
//
function btwb_validate_options($input) {
  global $BTWB_SETTINGS_FIELD_VALIDATION_RULES;
  global $BTWB_SETTINGS_FIELD_DEFAULTS;
  $newinput = $BTWB_SETTINGS_FIELD_DEFAULTS;
  foreach($BTWB_SETTINGS_FIELD_VALIDATION_RULES as $field => $regex) {
    $value = $input[$field];
    if(preg_match($regex, $value)) {
      $newinput[$field] = $value;
    }
  }
  return $newinput;
}


///////////////////////////////////////////////////////////////////////////////
// SETTINGS OPTIONS HELPER METHODS FOR REST OF PLUGIN
//

// Helper function to get the btwb options array.
function btwb_options() {
  return get_option(BTWB_OPTIONS);
}

// Gets the value of a specific settings option.
function btwb_get_option($key) {
  $options = btwb_options();
  return $options[$key];
}

// Gets the HTML Safe value of a specific settings option.
function btwb_get_htmlsafe_option($key) {
  $option = btwb_get_option($key);
  $value = htmlspecialchars($option, ENT_NOQUOTES | ENT_QUOTES);
  return $value;
}


///////////////////////////////////////////////////////////////////////////////
// SETTINGS OPTIONS HELPER METHODS FOR REST OF PLUGIN
//

function btwb_html_h_text_input_tag($key) {
  $value = btwb_get_htmlsafe_option($key);
?>
  <input
    id="<?php echo $key ?>"
    name="btwb_options[<?php echo $key ?>]"
    size="40"
    type="text"
    value="<?php echo $value ?>" />
<?
}


///////////////////////////////////////////////////////////////////////////////
// HTML String Generation for Settings Panel.
//

function btwb_html_s_general() {
?><p>Main Beyond the Whiteboard plugin settings.</p><?php
}

function btwb_html_s_wod() {
?><p>Settings for the [wod] shortcode.</p><?php
}

function btwb_html_s_wod_list() {
?><p>Settings for the [wod_list] shortcode.</p><?php
}

function btwb_html_s_activities() {
?><p>Settings for the [activities] shortcode.</p><?php
}

function btwb_html_s_leaderboard() {
?><p>Settings for the [leaderboard] shortcode.</p><?php
}

function btwb_html_sf_api_key() {
  btwb_html_h_text_input_tag(BTWB_SF_API_KEY);
}

function btwb_html_sf_wod_section() {
  btwb_html_h_text_input_tag(BTWB_SF_WOD_SECTION);
}

function btwb_html_sf_wod_leaderboard_length() {
  btwb_html_h_text_input_tag(BTWB_SF_WOD_LEADERBOARD_LENGTH);
}

function btwb_html_sf_wod_activities_length() {
  btwb_html_h_text_input_tag(BTWB_SF_WOD_ACTIVITIES_LENGTH);
}

function btwb_html_sf_wod_list_days_back() {
  btwb_html_h_text_input_tag(BTWB_SF_WOD_LIST_DAYS_BACK);
}

function btwb_html_sf_wod_list_section() {
  btwb_html_h_text_input_tag(BTWB_SF_WOD_LIST_SECTION);
}

function btwb_html_sf_wod_list_leaderboard_length() {
  btwb_html_h_text_input_tag(BTWB_SF_WOD_LIST_LEADERBOARD_LENGTH);
}

function btwb_html_sf_wod_list_activities_length() {
  btwb_html_h_text_input_tag(BTWB_SF_WOD_LIST_ACTIVITIES_LENGTH);
}

function btwb_html_sf_activities_length() {
  btwb_html_h_text_input_tag(BTWB_SF_ACTIVITIES_LENGTH);
}

function btwb_html_sf_leaderboard_length() {
  btwb_html_h_text_input_tag(BTWB_SF_LEADERBOARD_LENGTH);
}


///////////////////////////////////////////////////////////////////////////////
// WORDPRESS HTML Javascript Injection
//

add_action('init', 'btwb_javascript_register');
add_action('wp_footer', 'btwb_javascript_print');

function btwb_javascript_register() {
  // Get the SDK script loaded
  wp_enqueue_script(
    'btwb-javascript-sdk',
    BTWB_JAVASCRIPT_SDK_URL,
    array('jquery'),
    false,
    true);

  // Enqueue the our initialization script
  wp_enqueue_script(
    'btwb-javascript-init',
    plugins_url(BTWB_JAVASCRIPT_INIT_FILE, __FILE__),
    array('jquery', 'btwb-javascript-sdk'),
    false,
    true);

  // Make sure our config is in a javascript object for init.
  wp_localize_script(
    'btwb-javascript-init',
    BTWB_JAVASCRIPT_CONFIG_OBJECT_NAME,
    array(
      BTWB_JAVASCRIPT_API_KEY_PROPERTY => btwb_get_option(BTWB_SF_API_KEY)
    ));
}

function btwb_javascript_print() {
  wp_print_scripts('btwb-javascript');
}


///////////////////////////////////////////////////////////////////////////////
// Short Codes
//

add_shortcode('wod', 'btwb_shortcode_wod');
add_shortcode('wod_list', 'btwb_shortcode_wod_list');
add_shortcode('activities', 'btwb_shortcode_activities');
add_shortcode('leaderboard', 'btwb_shortcode_leaderboard');

///////////////////////////////////////////////////////////////////////////////
// Short Codes, parameters to send to WebWidgets HTTP service.
//

$BTWB_SHORTCODE_WOD_PARAMS_LIST = array(
  'date' => false,
  'track_ids' => false,
  'gym_id' => false,
  'section' => BTWB_SF_WOD_SECTION,
  'leaderboard_length' => BTWB_SF_WOD_LEADERBOARD_LENGTH,
  'activities_length' => BTWB_SF_WOD_ACTIVITIES_LENGTH
);
$BTWB_SHORTCODE_WOD_LIST_PARAMS_LIST = array(
  'track_ids' => false,
  'gym_id' => false,
  'days' => BTWB_SF_WOD_LIST_DAYS_BACK,
  'section' => BTWB_SF_WOD_LIST_SECTION,
  'leaderboard_length' => BTWB_SF_WOD_LIST_LEADERBOARD_LENGTH,
  'activities_length' => BTWB_SF_WOD_LIST_ACTIVITIES_LENGTH
);
$BTWB_SHORTCODE_ACTIVITIES_PARAMS_LIST = array(
  'gym_id' => false,
  'activities_length' => BTWB_SF_ACTIVITIES_LENGTH
);
$BTWB_SHORTCODE_LEADERBOARD_PARAMS_LIST = array(
  'workout_id' => false,
  'gym_id' => false,
  'leaderboard_length' => BTWB_SF_LEADERBOARD_LENGTH
);


///////////////////////////////////////////////////////////////////////////////
// Short Codes HTML builders.
//

// Create the [wod] shortcode for displaying track events.
function btwb_shortcode_wod($atts) {
  global $BTWB_SHORTCODE_WOD_PARAMS_LIST;
  return btwb_sc_html_tag(
    'btwb_gym_wod',
    $BTWB_SHORTCODE_WOD_PARAMS_LIST,
    $atts,
    'Loading the Wod from Beyond the Whiteboard');
}

// Create the [wod_list] shortcode for displaying track events.
function btwb_shortcode_wod_list($atts) {
  global $BTWB_SHORTCODE_WOD_LIST_PARAMS_LIST;
  return btwb_sc_html_tag(
    'btwb_gym_wod_list',
    $BTWB_SHORTCODE_WOD_LIST_PARAMS_LIST,
    $atts,
    'Loading the Wods List from Beyond the Whiteboard');
}

// Create the [activities] shortcode for displaying gym activities
function btwb_shortcode_activities($atts) {
  global $BTWB_SHORTCODE_ACTIVITIES_PARAMS_LIST;
  return btwb_sc_html_tag(
    'btwb_gym_activities',
    $BTWB_SHORTCODE_ACTIVITIES_PARAMS_LIST,
    $atts,
    "Loading the Gym's Posts from Beyond the Whiteboard");
}

// Create the [leaderboard] shortcode for displaying the workout leaderboard
function btwb_shortcode_leaderboard($atts) {
  global $BTWB_SHORTCODE_LEADERBOARD_PARAMS_LIST;
  return btwb_sc_html_tag(
    'btwb_gym_leaderboard',
    $BTWB_SHORTCODE_LEADERBOARD_PARAMS_LIST,
    $atts,
    'Loading the Leaderboard from Beyond the Whiteboard');
}


///////////////////////////////////////////////////////////////////////////////
// HELPER METHODS FOR THE SHORTCODE METHODS
//

// Create an HTML tag that the Javscript SDK will read and interpret.
function btwb_sc_html_tag($tag_class, $params_list, $atts, $msg) {
  $params = btwb_sc_encode_params($params_list, $atts);
  return "<div class='{$tag_class}' data-params='{$params}'><a class='btwb_landing_page' href='http://www.beyondthewhiteboard.com/'>{$msg}</a></div>";
}

// Get the HTML safe string of the json encoded shortcode parameters
function btwb_sc_encode_params($params_list, $atts) {
  // Get the defaults from the settings api for the shortcode's params list.
  // Then override those values with attributes from the shortcode tag itself.
  // JSON encode the params, then html safe the string.
  $params_defaults = btwb_sc_default_params($params_list);
  $params = shortcode_atts($params_defaults, $atts);
  $params_json = json_encode($params);
  $params_htmlsafe = htmlspecialchars($params_json, ENT_NOQUOTES | ENT_QUOTES);
  return $params_htmlsafe;
}

// This funtion takes the shortcode's params list, and grabs the
// default from the plugin saved settings and returns an associative
// array of the WebWidget's URL params to the default values.
function btwb_sc_default_params($params_list) {
  $func = function($value) {
    if(is_string($value)) {
      return btwb_get_option($value);
    } else {
      return NULL;
    }
  };
  $params = array_map($func, $params_list);
  return $params;
}



///////////////////////////////////////////////////////////////////////////////
// TinyMCE Hooks
//

// Registers the our tinymce plugin
add_action('init', 'btwb_tinymce_buttons_init');
function btwb_tinymce_buttons_init() {
  // Permission check
  if(!current_user_can('edit_posts') &&
      !current_user_can('edit_pages') &&
      get_user_option('rich_editing') == 'true') {
  return;
  }

  // Registers the TinyMCE plugin
  add_filter('mce_external_plugins', 'btwb_tinymce_buttons_register_plugin'); 

  // Add callback to TinyMCE toolbar
  add_filter('mce_buttons', 'btwb_tinymce_add_buttons');
}

function btwb_tinymce_buttons_register_plugin($plugin_array) {
  $plugin_array['btwb_tinymce_buttons'] =
    plugins_url('tinymce-buttons.js', __FILE__);
  return $plugin_array;
}

function btwb_tinymce_add_buttons($buttons) {
  array_push(
    $buttons,
    '|',
    'btwb_button_wod',
    'btwb_button_wod_list',
    'btwb_button_activities',
    'btwb_button_leaderboard');
  return $buttons;
}

?>
