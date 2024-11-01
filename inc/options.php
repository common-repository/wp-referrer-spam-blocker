<?php
//add to menu dashboard
if( is_admin() ) {
add_action( 'admin_menu', 'rsb_stats_count' );
}
function rsb_stats_count() {
// Add the top level menu page
add_menu_page( 'Spam Blocker', 'Spam Blocker', 'manage_options','rsb-admin-menu', '', '
dashicons-megaphone',75 );
// subpage
add_submenu_page( 'rsb-admin-menu', 'Spam Blocker', 'Spam Blocker','manage_options', 'rsb-admin-menu', 'rsb_create_admin_dashboard' );
}
function rsb_create_admin_dashboard() {
?>
<div id="blocklist-container">
<h2>Refferer Spam Blocker</h2>

<form action="options.php" method="post">

<div>
<?php 
settings_fields('rsb_options');
do_settings_sections('rsb-settings-admin');
?>

<div><a id="add-url"><span class="plus-circle">&#x2b;</span> <b>Add URL</b></a></div>

</div> 

<?php submit_button(); ?>
 
</form>

</div>
<?php
}
if( is_admin() ) {
add_action( 'admin_init', 'rsb_register_options' );
}
function rsb_register_options() {
  //add settings
register_setting( 'rsb_options', 'rsb-options' );
add_settings_field('stat', 'Blocked URL`s:', 'rsb_callback', 'rsb-settings-admin', 'rsb-defaults');
add_settings_section( 'rsb-defaults', 'Currently Blocked', 'rsb_section_info', 'rsb-settings-admin' );
}//rsb_register_options


function rsb_callback() {
$blocklist = get_option('rsb-options');

//now loop throught organized values and create fields
if( is_array($blocklist) )
{
  foreach( $blocklist as $url ){

   echo '<input type="text" class="list-key" name="rsb-options[]" value="'. ( $url ? $url : '' ) .'" placeholder="enter new URL" />';
  
  }//foreach close
}

}//rsb_callback end

function rsb_section_info() {
  echo '<p>Add Referrer URL you want to blacklist.</p>';
}

?>
