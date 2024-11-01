<?php
/**
  * Plugin Name: WP Referrer Spam Blocker
  * Plugin URI: http://botcrawl.com
  * Version: 1.9
  * Author: Botcrawl.com
  * Author URI: http://botcrawl.com
  * Description: Automatically stop referrer spam and unwanted referral traffic from reaching your site and ruining your Google Analytics data. Once installed, this plugin will run a check in the background, keeping unwanted referral traffic away. It will save your Google Analytics reports from showing unwanted referral traffic.
  * Text Domain: rsb
  * Domain Path: /languages
  * License: GPL
  */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if this file is accessed directly

load_plugin_textdomain( 'rsb', false, 'languages' );

//include files
require_once 'inc/setup.php';
require_once 'inc/options.php';

// Hooks
register_activation_hook(__FILE__, 'rsb_activate');
register_deactivation_hook(__FILE__, 'rsb_deactivate');
register_uninstall_hook(__FILE__, 'rsb_uninstall');
add_action( 'admin_head','rsb_admin_style' );
add_action( 'admin_footer','rsb_admin_script' );
add_action( 'parse_request', 'rsb_check'  );

function rsb_activate()
{
  $spamlist = array(
     0 => 'event-tracking.com',
     1 => '100dollars-seo.com',
     2 => '4webmasters.org',
     3 => '7makemoneyonline.com',
     4 => 'adviceforum.info',
     5 => 'aliexpress.com',
     6 => 'anticrawler.org',
     7 => 'avtlg.ru',
     8 => 'bashtel.ru',
     9 => 'depositfiles-porn.ga',
	 10 => 'best-seo-solution.com',
	 11 => 'bestsub.com',
	 12 => 'bestwebsitesawards.com',
	 13 => 'buy-cheap-online.info',
	 14 => 'corbina.ru',
	 15 => 'domination.ml',
	 16 => 'econom.co',
	 17 => 'ertelecom.ru',
	 18 => 'guardlink.com',
	 19 => 'hol.es',
	 20 => 'hulfingtonpost.com',
	 21 => 'is74.ru',
	 22 => 'kabbalah-red-bracelets.com',
	 23 => 'kambasoft.com',
	 24 => 'kes.ru',
	 25 => 'makemoneyonline.com',
	 26 => 'mts.ru',
	 27 => 'mts-nn.ru',
	 28 => 'nationalcablenetworks.ru',
	 29 => 'netbynet.ru',
	 30 => 'pornhub-forum.ga',
	 31 => 'sanjosestartups.com',
	 32 => 'sashagreyblog.ga',
	 33 => 'savetubevideo.com',
	 34 => 'sitequest.ru',
	 35 => 'social-buttons.com',
	 36 => 'theguardlan.com',
	 37 => 'torture.ml',
	 38 => 'trafficmonetizer.net',
	 39 => 'uni.me',
	 40 => 'webmonetizer.net',
	 41 => 'semalt.com',
	 42 => 'semaltmedia.com',
	 43 => 'how-to-earn-quick-money.com',
	 44 => 'sexyali.com',
	 45 => 'alieexpress.com',
	 46 => 'get-free-social-traffic.com',
	 47 => 'free-floating-buttons.com ',
	 48 => 'satellite.maps.ilovevitaly.com',
	 49 => 'chinese-amezon.com',
	 50 => 'traffic2money.com',
	 51 => 'e-buyeasy.com',
	 52 => 'wpsecuritycheck.co.uk',
	 53 => 'qualitymarketzone.com',
	 53 => 'seo-platform.com',
	 54 => 'best-seo-software.xyz',
	 55 => 'justprofit.xyz',
	 56 => 'baixar-musicas-gratis.com',
	 57 => 'acads.net',
	 58 => 'fbdownloader.com',
	 59 => 'adspart.com',
	 60 => 'akuhni.by',
	 61 => 'affordablewebsitesandmobileapps.com',
	 62 => 'alpharma.net',
	 63 => 'baladur.ru',
	 64 => 'seo-smm.kz',
	 65 => 'rednise.com',
	 66 => 'rankings-analytics.com',
	 67 => 'alibestsale.com',
	 68 => 'copyrightclaims.org',
	 69 => 'claim381811.copyrightclaims.org',
	 70 => 'claim42465581.copyrightclaims.org'
	 );
  update_option('rsb-options', $spamlist );
  flush_rewrite_rules();
} 

function rsb_deactivate()
{
  flush_rewrite_rules();
}

function rsb_uninstall(){
  delete_option('bld-options');
}
?>
