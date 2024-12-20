<?php

define( 'STATSPLUGIN_INCLUDES_DIR', plugin_dir_path( __FILE__ ) );
define( 'STATSPLUGIN_TEMPLATES_DIR', STATSPLUGIN_ROOT_DIR . "templates/" );

require_once STATSPLUGIN_ROOT_DIR . "vendor/autoload.php";

require_once STATSPLUGIN_INCLUDES_DIR . 'class.statsplugin.php';
new StatsPlugin();

if ( is_admin() ) {
	require_once STATSPLUGIN_INCLUDES_DIR . 'class.statsplugin-admin.php';
  new StatsPluginAdmin();
}
