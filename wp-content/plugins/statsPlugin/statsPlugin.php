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
  private $sectionName;
  private $displayLocationFieldName;
  private $headlineTextFieldName;
  private $wordCountFieldName;
  private $characterCountFieldName;
  private $readTimeFieldName;

  function __construct()
  {
    $this->pluginName = "statsplugin";
    $this->pageName = "stats-settings-page";
    $this->sectionName = "sp_section";
    $this->displayLocationFieldName = "sp_displaylocation";
    $this->headlineTextFieldName = "sp_headlinetext";
    $this->wordCountFieldName = "sp_wordcount";
    $this->characterCountFieldName = "sp_charactercount";
    $this->readTimeFieldName = "sp_readtime";

    add_action("admin_menu", array($this, "addStatsPluginSettingsLink"));
    add_action("admin_init", array($this, "addSettings"));
  }

  function addSettings(){
    add_settings_section($this->sectionName, null, null, $this->pageName);

    // Display location
    add_settings_field($this->displayLocationFieldName, "Display location", array($this, "showDisplayLocationFieldHtml"), $this->pageName, $this->sectionName);
    register_setting($this->pluginName, $this->displayLocationFieldName, array("sanitize_callback" => "sanitize_text_field", "default" => "start"));

    // Headline text
    add_settings_field($this->headlineTextFieldName, "Headline text", array($this, "showHeadlineTextFieldHtml"), $this->pageName, $this->sectionName);
    register_setting($this->pluginName, $this->headlineTextFieldName, array("sanitize_callback" => "sanitize_text_field", "default" => ""));

    // Word count
    add_settings_field($this->wordCountFieldName, "Word count", array($this, "showWordCountField"), $this->pageName, $this->sectionName);
    register_setting($this->pluginName, $this->wordCountFieldName, array("sanitize_callback" => "sanitize_text_field", "default" => ""));

    // Character count
    add_settings_field($this->characterCountFieldName, "Character count", array($this, "showCharacterCountField"), $this->pageName, $this->sectionName);
    register_setting($this->pluginName, $this->characterCountFieldName, array("sanitize_callback" => "sanitize_text_field", "default" => ""));

    // Read time 
    add_settings_field($this->readTimeFieldName, "Read time", array($this, "showReadTimeField"), $this->pageName, $this->sectionName);
    register_setting($this->pluginName, $this->readTimeFieldName, array("sanitize_callback" => "sanitize_text_field", "default" => ""));
  }

  function addStatsPluginSettingsLink(){
    add_options_page("Stats Plugin", "Stats Plugin", "manage_options", $this->pageName, array($this, "showPageHtml"));
  }

  function showPageHtml(){ ?>
    <h1>Stats Settings</h1>

    <form action="options.php" method="POST">
      <?php settings_fields($this->pluginName); ?>
      <?php do_settings_sections($this->pageName); ?>
      <?php submit_button(); ?>
    </form>
  <?php }

  function showDisplayLocationFieldHtml(){ ?>
    <select name="<?php echo $this->displayLocationFieldName; ?>">
      <option value="start" <?php selected(get_option($this->displayLocationFieldName), "start"); ?> >Start of post</option>
      <option value="end" <?php selected(get_option($this->displayLocationFieldName), "end"); ?>>End of post</option>
    </select>
  <?php }

  function showHeadlineTextFieldHtml(){ ?>
    <input type="text" name="<?php echo $this->headlineTextFieldName; ?>" value="<?php echo esc_attr(get_option($this->headlineTextFieldName)); ?>"  />
  <?php }

  function showCheckBoxField($name){ ?>
    <input type="checkbox" name="<?php echo $name; ?>" <?php echo checked(get_option($name)); ?> value="1"/>
  <?php }

  function showWordCountField(){
    $this->showCheckBoxField($this->wordCountFieldName);
  }

  function showCharacterCountField(){
    $this->showCheckBoxField($this->characterCountFieldName);
  }

  function showReadTimeField(){
    $this->showCheckBoxField($this->readTimeFieldName);
  }
}

new StatsPlugin();