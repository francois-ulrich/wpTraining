<?php




class StatsPluginAdmin{
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

  function addStatsPluginSettingsLink(){
    add_options_page("Stats Plugin", "Stats Plugin", "manage_options", $this->pageName, array($this, "showPageHtml"));
  }

  function addSettings(){
    add_settings_section($this->sectionName, null, null, $this->pageName);

    // Display location
    add_settings_field($this->displayLocationFieldName, "Display location", array($this, "showDisplayLocationFieldHtml"), $this->pageName, $this->sectionName);
    register_setting($this->pluginName, $this->displayLocationFieldName, array("sanitize_callback" => array($this, "sanitizeDisplayLocation"), "default" => "start"));

    // Headline text
    add_settings_field($this->headlineTextFieldName, "Headline text", array($this, "showHeadlineTextFieldHtml"), $this->pageName, $this->sectionName);
    register_setting($this->pluginName, $this->headlineTextFieldName, array("sanitize_callback" => "sanitize_text_field", "default" => ""));

    // Word count
    add_settings_field($this->wordCountFieldName, "Word count", array($this, "showCheckBoxField"), $this->pageName, $this->sectionName, array("fieldName" => $this->wordCountFieldName));
    register_setting($this->pluginName, $this->wordCountFieldName, array("sanitize_callback" => "sanitize_text_field", "default" => "1"));

    // Character count
    add_settings_field($this->characterCountFieldName, "Character count", array($this, "showCheckBoxField"), $this->pageName, $this->sectionName, array("fieldName" => $this->characterCountFieldName));
    register_setting($this->pluginName, $this->characterCountFieldName, array("sanitize_callback" => "sanitize_text_field", "default" => "1"));

    // Read time 
    add_settings_field($this->readTimeFieldName, "Read time", array($this, "showCheckBoxField"), $this->pageName, $this->sectionName, array("fieldName" => $this->readTimeFieldName));
    register_setting($this->pluginName, $this->readTimeFieldName, array("sanitize_callback" => "sanitize_text_field", "default" => "1"));
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

  function showCheckBoxField($args){ ?>
    <input type="checkbox" name="<?php echo $args["fieldName"]; ?>" <?php echo checked(get_option($args["fieldName"])); ?> value="1"/>
  <?php }

  function sanitizeDisplayLocation($input){
    if($input == "start" || $input == "end")
      return $input;

    add_settings_error($this->displayLocationFieldName, $this->displayLocationFieldName."_error", "Display location must be either \"start\" or \"end\"");
    return get_option($this->displayLocationFieldName);
  }
}