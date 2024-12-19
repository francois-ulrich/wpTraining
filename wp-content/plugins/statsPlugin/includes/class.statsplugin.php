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
    $data = [
        'title' => "Page stats",
    ];

    $templateLoader = new FilesystemLoader(STATSPLUGIN_TEMPLATES_DIR);
    $twig = new Environment($templateLoader);

    $renderedTemplate = $twig->render('stats-block.html.twig', $data);

    return $content . $renderedTemplate;
  }
}