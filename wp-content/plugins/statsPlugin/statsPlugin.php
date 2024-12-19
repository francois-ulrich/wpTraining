<?php

/*
  Plugin Name: Stats Plugin
  Description: A plugin for displaying stats
  Version: 1.0
  Author: Francois
  Author URI: https://github.com/francois-ulrich
*/

define( 'STATSPLUGIN__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once STATSPLUGIN__PLUGIN_DIR . 'class.statsplugin-admin.php';
  new StatsPluginAdmin();
}