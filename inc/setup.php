<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if this file is accessed directly

function rsb_admin_style()
{
  ?>
  <style>
    #blocklist-container .list-key{
      display: block;
      margin: 5px;
      padding: 6px;
      max-width: 320px;
    }
    #blocklist-container #add-url{
      cursor: pointer;
      margin-left: 220px;
    }
  </style>
  <?php
}

function rsb_admin_script()
{
  ?>
   <script>
    (function(){
       if( document.getElementById('blocklist-container') ){
         var container = document.getElementById('blocklist-container');
         var tableRow = container.getElementsByTagName('FORM')[0].getElementsByTagName('TABLE')[0].getElementsByTagName('TR')[0];
         var td = tableRow.getElementsByTagName('TD')[0];
         var add = document.getElementById('add-url');
         if (window.addEventListener) { 
            add.addEventListener('click', addNew, false);
         } else if (window.attachEvent) {
            add.attachEvent('click', addNew);
         }
       }
       function addNew(){
          var i = document.createElement('input');
          i.setAttribute('type', 'text');
          i.setAttribute('name', 'rsb-options[]');
          i.setAttribute('placeholder',"enter new URL");
          i.classList.add('list-key');
          td.appendChild(i);
       }
    })();
   </script>
  <?php
}

// function to check refferer
function rsb_check()
{
  $blocklist = get_option('rsb-options');   
  $refferer = $_SERVER['HTTP_REFERER'];
  $found = '';
  foreach( $blocklist as $url )
  {  
    if( strpos($url,'http://') !== false )
    {
      $addr = ltrim( str_replace('http://', '', $url) );
      $found = preg_match_all( '/\b'. $addr .'\b/i', $refferer, $match );
    } 
    else if( strpos($url,'www.') !== false )
    {
      $addr = ltrim( str_replace('www.', '', $url) );
      $found = preg_match_all( '/\b'. $addr .'\b/i', $refferer, $match );
    }
    else if( strpos($url,'http://www.') !== false )
    {
      $addr = ltrim( str_replace('http://www.', '', $url) );
      $found = preg_match_all( '/\b'. $addr .'\b/i', $refferer, $match );
    } else {
      $addr = $url;
      $found = preg_match_all( '/\b'. $addr .'\b/i', $refferer, $match );
    }
    if( $found )
    {
      wp_die( __('Website Loading Terminated. You can add some message here', 'rsb') );
    }
  }
}
?>
