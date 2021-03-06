<?php
/*
Plugin Name: Related Content Picker
Description: Adds the ability to choose a related content item or default to the inherited page's related content item.
Author: Jen Wachter
Version: 0.1
*/

class RelatedContentPicker
{
  public function __construct()
  {
    add_action('acf/include_field_types', function () {
      new \RelatedContentPicker\Field();
    });
  }
}

new RelatedContentPicker();
