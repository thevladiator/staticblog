<?php

require_once dirname(__DIR__) . '/config/Config.php';
require_once 'Category.php';
require_once 'Tag.php';

class Page {
  // Properties
  public Config $config;
  public string $title;
  public string $slug;
  public string $canonical;

  // Constructor
  public function __construct($title, $slug) {
    $this->config = new Config();
    $this->title = $title;
    $this->slug = $slug;
    $this->canonical = "https://www.{$this->config->SITE_NAME}/pages/{$this->slug}.html";
  }

  public function toListItemHTML() {
      return "<li class=\"page-list-item\"><a href=\"{$this->config->SITE_URL_ROOT}/pages/{$this->slug}.html\">$this->title</a></li>";
  }

  public function toCommaSeparatedTitle() {
    $words = explode(' ', trim($this->title));
    return implode(', ', $words);
  }

  public function toSiteMapItemXML($xml) {
    $url = $xml->addChild('url');
    $url->addChild('loc', htmlspecialchars("$this->canonical"));
    $url->addChild('lastmod', date('Y-m-d'));
    $url->addChild('changefreq', 'monthly');
    $url->addChild('priority', '0.3');
  }
}
