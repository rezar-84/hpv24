<?php
function gavias_pagebuilder_load($pid) {
  $result = \Drupal::database()->select('{gavias_pagebuilder}', 'd')
          ->fields('d')
          ->condition('id', $pid, '=')
          ->execute()
          ->fetchObject();
  $page = new stdClass();
  if($result){
    $page->title =  $result->title;
    $page->id = $result->id;  
    $page->params = $result->params;  
  }else{
    $page->title = '';
    $page->params = array();
  }
  return $page;
}

function gavias_pagebuilder_load_by_machine($mid) {
  $result = \Drupal::database()->select('{gavias_pagebuilder}', 'd')
          ->fields('d', array('id', 'title', 'params'))
          ->condition('body_class', $mid, '=')
          ->execute()
          ->fetchObject();
  $page = new stdClass();
  if($result){
    $page->id = $result->id;
    $page->title = $result->title;
    $page->params = $result->params;  
  }else{
    return false;
  }
  $result = null;
  return $page;
}

function gavias_pagebuilder_check_machine($id, $mid){
  $result = \Drupal::database()->select('{gavias_pagebuilder}', 'd')
    ->fields('d')
    ->condition('id', $id , '<>')
    ->condition('body_class', $mid, '=')
    ->execute()
    ->fetchObject();
  if($result && $result->body_class){
    return true;
  }   
  return false;
}

function gavias_pagebuilder_get_list(){
  $result = \Drupal::database()->select('{gavias_pagebuilder}', 'd')
    ->fields('d')
    ->execute();
  return $result;
}