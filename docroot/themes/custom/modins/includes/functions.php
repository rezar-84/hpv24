<?php
function modins_render_block($key) {
 $block = \Drupal\block\Entity\Block::load($key);
  if($block){
  $block_content = \Drupal::entityTypeManager()
    ->getViewBuilder('block')
    ->view($block);
    return \Drupal::service('renderer')->render($block_content);
  }  
  return '';
}

function modins_makeid($length = 5){
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $randomString;
}

function modins_base_url(){
  global $base_url;
  $theme_path = \Drupal::service('extension.list.theme')->getPath('modins');
  return $base_url . '/' . $theme_path . '/';
}

global $gva_node_index;
function modins_preprocess_node(&$variables) {
  global $gva_node_index;
  $gva_node_index = $gva_node_index + 1;
  $variables['gva_node_index'] = $gva_node_index;
  
  $date = $variables['node']->getCreatedTime();
  $variables['date'] = t(date( 'F', $date)) . ' ' . t(date( 'j', $date)) . ', ' .t(date( 'Y', $date));
  
  if ($variables['teaser'] || !empty($variables['content']['comments']['comment_form'])) {
    unset($variables['content']['links']['comment']['#links']['comment-add']);
  }
  if ($variables['node']->getType() == 'article') {
      $node = $variables['node'];
      $post_format = 'standard';
      try{
         $field_post_format = $node->get('field_post_format');
         if(isset($field_post_format->value) && $field_post_format->value){
            $post_format = $field_post_format->value;
         }
      }catch(Exception $e){
         $post_format = 'standard';
      }

      $iframe = '';
      if($post_format == 'video' || $post_format == 'audio'){
         try{
            $field_post_embed = $node->get('field_post_embed');
            if(isset($field_post_embed->value) && $field_post_embed->value){
               $autoembed = new AutoEmbed();
               $iframe = $autoembed->parse($field_post_embed->value);
            }else{
               $iframe = '';
               $post_format = 'standard';
            }
         }
         catch(Exception $e){
            $post_format = 'standard';
         }
      }
      $variables['gva_iframe'] = $iframe;
      $variables['post_format'] = $post_format;
  }
}

function _modins_preprocess_node__portfolio(&$variables){
  $node = $variables['node'];
  
  // Override lesson list on single course
  $output = '';
  $count_information = 0;
  if($node->hasField('field_portfolio_information')){
    $informations = $node->get('field_portfolio_information');
    $count_information = count($informations);
    foreach ($informations as $key => $information) {
      $texts = preg_split('/--/', $information->value);
        $information_text = '';
        foreach ($texts as $k => $text) {
          $information_text .= '<span>' . $text . '</span>';
        }
      $output .= '<div class="item-information">' . $information_text . '</div>';
    }
  }
  $variables['count_information'] = $count_information;
  $variables['informations'] = $output;
}

function modins_preprocess_node__event(&$variables){
  $node = $variables['node'];
  $event_date = array();
  if($node->hasField('field_event_start')){
    $event_start = $node->field_event_start->value;
    if($event_start){ 
      $event_date['day'] = \Drupal::service('date.formatter')->format(strtotime($event_start), 'custom', 'd');
      $event_date['month'] = \Drupal::service('date.formatter')->format(strtotime($event_start), 'custom', 'F');
    }
  }
  $variables['event_date'] = $event_date;
  $variables['theme_uri'] = base_path() . \Drupal::service('extension.list.theme')->getPath('modins');
  $variables['google_key'] = theme_get_setting('google_key');
}

function modins_preprocess_breadcrumb(&$variables){
  $variables['#cache']['max-age'] = 0;

  $request = \Drupal::request();
  $title = '';
  if ($route = $request->attributes->get(\Drupal\Core\Routing\RouteObjectInterface::ROUTE_OBJECT)) {
    $title = \Drupal::service('title_resolver')->getTitle($request, $route);
  }

  if($variables['breadcrumb']){
     foreach ($variables['breadcrumb'] as $key => &$value) {
      if($value['text'] == 'Node'){
        unset($variables['breadcrumb'][$key]);
      }
    }
    if(!empty($title)){
      $variables['breadcrumb'][] = array(
        'text' => ''
      );
      $variables['breadcrumb'][] = array(
        'text' => $title
      );
    }  
  }
}

function modins_print_icon($file, $alt){
  $file_content = file_get_contents($file);
  if(substr($file, -4) == '.svg'){
    echo $file_content;
  }else{
    echo '<img src="' . ($file) . '" alt="' . ($alt) . '" />';
  }
}
