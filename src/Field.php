<?php

namespace RelatedContentPicker;

class Field extends \acf_field
{
  public $defaults;

  public function __construct()
  {
    $this->name = 'related_content_picker';
    $this->label = __('Related Content Picker');
    $this->category = __("Choice",'acf');
    $this->defaults = array(
      "multiple" =>  0
    );

    parent::__construct();
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

  public function render_field($field)
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

  /**
   * This filter is appied to the $value after it is loaded from the
   * database and before it is returned to the template
   */
  function format_value( $value, $post_id, $field )
  {
    if (empty($value)) return null;

    if ($value == "inherit") {
      $value = $this->findParentMenu($post_id);
    }

    return $value;
  }

  protected function findParentMenu($id)
  {
    $ansestors = get_post_ancestors($id);

    foreach ($ansestors as $id) {

      $parent = get_post_meta($id, "region_related_sidebar", true);
      if ($parent == "inherit") continue;
      return $parent;

    }

    // nothing found
    return null;
  }

}
