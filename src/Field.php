<?php

namespace RelatedContentPicker;

class Field extends \acf_field
{   
  public $settings;
  public $defaults;
        
  public function __construct($logger)
  {
    $this->name = 'related_content_picker';
    $this->label = __('Related Content Picker');
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

  protected function getRelatedContentGroups()
  {
    $posts = get_posts(array(
      "post_type" => "related_content",
      "posts_per_page" => -1
    ));

    $related_content = array();

    foreach ($posts as $post) {
      $related_content[$post->ID] = $post->post_title;
    }

    $related_content["inherit"] = "Inherit Parent Sidebar";

    return $related_content;
  }
    
  public function create_field($field)
  {
    $value = $field["value"] ? $field["value"] : "inherit";

    echo "<div class='acf-input-wrap'>";
    echo '<select id="' . $field['id'] . '" class="' . $field['class'] . '" name="' . $field['name'] . '" >';

    $sidebars = $this->getRelatedContentGroups();

    foreach($sidebars as $k => $v) {

      $selected = $k == $value ? "selected='selected'" : "";
      echo "<option value='{$k}' {$selected}>{$v}</option>";
    }

    echo "</select>";
    echo "</div>";
  }

}
