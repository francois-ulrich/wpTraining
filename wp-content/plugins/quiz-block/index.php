<?php
/*
  Plugin Name: Quiz block
  Description: A quiz custom block
  Version: 1.0
  Author: Francois
  Author URI: https://github.com/francois-ulrich
  Text Domain: quizblockdomain
  Domain Path: /languages
*/

defined('ABSPATH') or die('Direct access not allowed.');

class QuizBlock {
  function __construct(){
    add_action("enqueue_block_editor_assets", array($this, "enqueueBlockType"));
  }

  function enqueueBlockType(){
    wp_enqueue_script("quizzBlockType", plugin_dir_url(__FILE__) . "test.js", array("wp-blocks", "wp-element"));
  }
}

new QuizBlock();