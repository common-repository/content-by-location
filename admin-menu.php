<?php 
add_action('admin_menu', 'plugin_admin_add_page');
function plugin_admin_add_page() {
add_options_page('Content by Location Settings Page', 'Content by Location', 'manage_options', 'content-by-Location', 'yh_options_page');
}

function yh_options_page() {
?>
<div>
<h2>Content By Location Settings</h2>
<h3><u>Documantation.</u></h3>
to show content by country just use the shortcode like this:<br/>
<code>
[cbl country="country code"] <br/>
your content <br/>
[/cbl]</code><br/>You can choose from the next dropbox your geoip service you want to work with.
<hr>
<form action="options.php" method="post">
<!--Output nonce, action, and option_page fields for a settings page.-->
<?php settings_fields('CBL_options'); ?>
<!--This will output the section titles wrapped in h3 tags and the settings fields wrapped in tables.-->
<?php do_settings_sections('CBL_Settings'); ?>
<br />
<input name="Submit" class="button-primary" type="submit" value="<?php _e('Save Changes'); ?>" />
</form></div>
<?php
}
// add the admin settings and such
add_action('admin_init', 'plugin_admin_init');
function plugin_admin_init(){
//Register a setting and its sanitization callback.
register_setting( 'CBL_options', 'CBL_options');
add_settings_section('plugin_main', '<u>Main Settings</u>', 'CBL_section_text', 'CBL_Settings');
add_settings_field('CBL_api_service', 'Please choose the geoip api to use in the shortcode: ', 'CBL_setting_string', 'CBL_Settings', 'plugin_main');
add_settings_field('CBL_unknown_lang', 'Please write the message to unknow language: ', 'CBL_unknown_lang', 'CBL_Settings', 'plugin_main');
}
function CBL_section_text() {
echo '';
} 
function CBL_unknown_lang() {
$options = get_option('CBL_options');
echo "<input type='text' maxlength='35' size='35' value=\"{$options['CBL_unknown_lang']}\" name='CBL_options[CBL_unknown_lang]'  />";
} 
function CBL_setting_string() {
$options = get_option('CBL_options');
?>
<select name='CBL_options[CBL_api_service]'>
    <option value='1' <?php selected( $options['CBL_api_service'], 1); ?>>smart-ip.net</option>
	<option value='2' <?php selected( $options['CBL_api_service'], 2 ); ?>>hostip.info</option>
    <option value='3' <?php selected( $options['CBL_api_service'], 3 ); ?>>maxmind.com (local database)</option>
</select><?php
} ?>