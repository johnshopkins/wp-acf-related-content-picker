<?php
/*
Plugin Name: RelatedContentPicker
Description: 
Author: johnshopkins
Version: 0.1
*/

class RelatedContentPicker
{
  public function __construct($logger)
  {
    $this->logger = $logger;

    add_action('acf/register_fields', function () {
      new \SidebarPicker\Field($this->logger);
    });
  }
}

new RelatedContentPicker($wp_logger);
