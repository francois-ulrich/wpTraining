<?php

/*
  Plugin Name: Stats Plugin
  Description: A plugin for displaying stats
  Version: 1.0
  Author: Francois
  Author URI: https://github.com/francois-ulrich
*/

class StatsPlugin{
  private $pluginName;
  private $pageName;
  private $displayLocationSectionName;
  private $displayLocationFieldName;

  function __construct()
  {
    $this->pluginName = "statsplugin";
    $this->pageName = "stats-settings-page";
    $this->displayLocationSectionName = "sp_displaylocation_section";
    $this->displayLocationFieldName = "sp_displaylocation";

    add_action("admin_menu", array($this, "addStatsPluginSettingsLink"));
    add_action("admin_init", array($this, "addSettings"));
  }

  function addSettings(){
    add_settings_section($this->displayLocationSectionName, null, null, $this->pageName);
    add_settings_field($this->displayLocationFieldName, "Display location", array($this, "getDisplayLocationHtml"), $this->pageName, $this->displayLocationSectionName);
    register_setting($this->pluginName, $this->displayLocationFieldName, array("sanitize_callback" => "sanitize_text_field", "default" => "start"));
  }

  function addStatsPluginSettingsLink(){
    add_options_page("Stats Plugin", "Stats Plugin", "manage_options", $this->pageName, array($this, "getPageHtml"));
  }

  function getPageHtml(){ ?>
    <h1>Stats Settings</h1>

    <form action="options.php" method="POST">
      <?php settings_fields($this->pluginName); ?>
      <?php do_settings_sections($this->pageName); ?>
      <?php submit_button(); ?>
    </form>
  <?php }

  function getDisplayLocationHtml(){ ?>
    <select name="<?php echo $this->displayLocationFieldName; ?>">
      <option value="start">Start of post</option>
      <option value="end">End of post</option>
    </select>
  <?php }
}

new StatsPlugin();