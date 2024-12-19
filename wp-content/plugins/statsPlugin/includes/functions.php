<?php

define( 'STATSPLUGIN_INCLUDES_DIR', plugin_dir_path( __FILE__ ) );
define( 'STATSPLUGIN_TEMPLATES_DIR', STATSPLUGIN_ROOT_DIR . "templates/" );

require_once STATSPLUGIN_ROOT_DIR . "/vendor/autoload.php";

// use Twig\Environment;
// use Twig\Loader\FilesystemLoader;

// $templateLoader = new FilesystemLoader('path/to/your/templates'); // Chemin relatif aux fichiers de vos templates.
// $twig = new Environment($templateLoader, [
//     'cache' => 'path/to/cache', // Optionnel : emplacement pour le cache Twig.
// ]);

require_once STATSPLUGIN_INCLUDES_DIR . 'class.statsplugin.php';
new StatsPlugin();

if ( is_admin() ) {
	require_once STATSPLUGIN_INCLUDES_DIR . 'class.statsplugin-admin.php';
  new StatsPluginAdmin();
}
