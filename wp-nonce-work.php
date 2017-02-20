<?php
	/**
	 * @link              https://www.deb.im
	 * @since             1.0.0
	 * @package           WordPress_Nonce
	 *
	 * @wordpress-plugin
	 * Plugin Name:       WordPress Nonce Plugins
	 * Plugin URI:        https://www.deb.im/
	 * Description:       WordPress Plugin to use of WordPress Nonce function, in theme or other plugins.
	 * Version:           1.0.0
	 * Author:            Debabrata Karfa
	 * Author URI:        https://www.deb.im | support@deb.im
	 * License:           GPL-2.0+
	 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
	 * Text Domain:       wordpress-nonce
	 */

	// If this file is called directly, abort.
	if ( ! defined( 'WPINC' ) ) {
		die;
	}

	/**
	 * WPN_VERSION constant for use anywhere in WordPress
	 */
	define( 'WPN_VERSION', '1.0.0' );
	define( 'WPN_URL',     plugin_dir_url( __FILE__ ) );
	define( 'WPN_PATH',    dirname( __FILE__ ) . '/' );

	require_once( __DIR__ . '/vendor/autoload.php' );

?>
