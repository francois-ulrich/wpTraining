<?php

/*
  Plugin Name: Stats Plugin
  Description: A plugin for displaying stats
  Version: 1.0
  Author: Francois
  Author URI: https://github.com/francois-ulrich
  Text Domain: spdomain
  Domain Path: /languages
*/

defined('ABSPATH') or die('Direct access not allowed.');
define( 'STATSPLUGIN_ROOT_DIR', plugin_dir_path( __FILE__ ) );
define( 'STATSPLUGIN_BASENAME', dirname(plugin_basename( __FILE__ )) );
include_once STATSPLUGIN_ROOT_DIR . 'includes/functions.php';
