<?php
/*
Plugin Name: Related Content Picker
Description: Adds the ability to choose a related content item or default to the inherited page's related content item.
Author: Jen Wachter
Version: 0.1
*/

class RelatedContentPicker
{
  public function __construct($logger)
  {
    $this->logger = $logger;

    add_action('acf/register_fields', function () {
      new \RelatedContentPicker\Field($this->logger);
    });
  }
}

new RelatedContentPicker($wp_logger);
