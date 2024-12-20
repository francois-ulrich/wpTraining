<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class StatsPlugin{
  function __construct()
  {
    add_filter("the_content", array($this, "checkIfEnabled"));
  }

  function checkIfEnabled($content){
    if (!is_main_query() || !is_single()) 
      return $content;

    return $this->render($content);
  }

  function render($content){
    $templateLoader = new FilesystemLoader(STATSPLUGIN_TEMPLATES_DIR);
    $twig = new Environment($templateLoader);

    $display = [
      "wordCount" => boolval(get_option("sp_wordcount", "0") == "1"),
      "characterCount" => boolval(get_option("sp_charactercount", "0") == "1"),
      "readTime" => boolval(get_option("sp_readtime", "0") == "1"),
    ];


    $rawText = strip_tags($content);

    $wordCount = str_word_count($rawText);
    $characterCount = strlen(str_replace(' ', '', $rawText));
    $readTimeInMinutes = round($wordCount/255);

    $data = [
        'headlineText' => get_option("sp_headlinetext", "Page stats"),
        "display" => $display,
        'wordCount' => $wordCount,
        'characterCount' => $characterCount,
        'readTimeInMinutes' => $readTimeInMinutes,
    ];

    $renderedTemplate = $twig->render('stats-block.html.twig', $data);

    if(get_option("sp_displaylocation", "start") == "end")
      return $content . $renderedTemplate;

    return $renderedTemplate . $content;
  }
}