<?php
/*
Plugin Name: SidebarPicker
Description: 
Author: johnshopkins
Version: 0.1
*/

class SidebarPickerMain
{
  public function __construct($logger)
  {
    $this->logger = $logger;

    add_action('acf/register_fields', function () {
      new \SidebarPicker\Field($this->logger);
    });
  }
}

new SidebarPickerMain($wp_logger);
