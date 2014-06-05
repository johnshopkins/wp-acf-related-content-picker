<?php

namespace SidebarPicker;

class Field extends \acf_field
{   
  public $settings;
  public $defaults;
        
  public function __construct($logger)
  {
    $this->name = 'sidebar_picker';
    $this->label = __('Sidebar Picker');
    $this->category = __("Choice",'acf');
    $this->defaults = array(
      "multiple" =>  0
    );
    
    parent::__construct();

    $this->settings = array(
        'path' => apply_filters('acf/helpers/get_path', __FILE__),
        'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
        'version' => '1.0.0'
    );
  }

  protected function getSidebars()
  {
    $posts = get_posts(array(
      "post_type" => "sidebar",
      "posts_per_page" => -1
    ));

    $sidebars = array();

    foreach ($posts as $sidebar) {
      $sidebars[$sidebar->ID] = $sidebar->post_title;
    }

    $sidebars["inherit"] = "Inherit Parent Sidebar";

    return $sidebars;
  }
    
  public function create_field($field)
  {
    $value = $field["value"] ? $field["value"] : "inherit";

    echo "<div class='acf-input-wrap'>";
    echo '<select id="' . $field['id'] . '" class="' . $field['class'] . '" name="' . $field['name'] . '" >';

    $sidebars = $this->getSidebars();

    foreach($sidebars as $k => $v) {

      $selected = $k == $value ? "selected='selected'" : "";
      echo "<option value='{$k}' {$selected}>{$v}</option>";
    }

    echo "</select>";
    echo "</div>";
  }

}
