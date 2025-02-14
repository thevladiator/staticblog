<?php

require_once dirname(__DIR__) . '/config/Config.php';
require_once dirname(__DIR__) . '/utils/Utilities.php';

class Tag {
  // Properties
  private Config $config;
  public string $title;
  public string $slug;
  public string $canonical;

  // Constructor
  public function __construct(string $title) {
    $this->config = new Config();
    $this->title = $title;
    $this->slug = Utilities::convertTitleToSlug($title);
    $this->canonical = "{$this->config->SITE_ADDRESS}/tag/{$this->slug}.html";
  }

  public function toListItemHTML() {
    return "<li class=\"tag-list-item\"><a href=\"{$this->config->SITE_URL_ROOT}/tag/{$this->slug}.html\">$this->title</a></li>";
  }
  
  public function toLinkHTML() {
    return "<span class=\"tag-link\"><a href=\"{$this->config->SITE_URL_ROOT}/tag/{$this->slug}.html\">$this->title</a></span>";
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