<?php
function gavias_sliderlayer_delete($gid) {
  return drupal_get_form('gavias_sliderlayer_delete_confirm_form');
}

function gavias_sliderlayer_delete_confirm_form($form_state) {
  $form = array();
  $form['id'] = array(
    '#type'=>'hidden',
    '#default_value' => arg(2)
  );
  return confirm_form($form, 'Do you really want to detele this block bulider ?', 'admin/gavias_sliderlayer', NULL, 'Delete', 'Cancel');
}

function gavias_sliderlayer_delete_confirm_form_submit($form, &$form_state){
  $gid = $form['id']['#value'];
  \Drupal::database()->delete('gavias_sliderlayer')
          ->condition('id', $gid)
          ->execute();
  \Drupal::messenger()->addMessage('The block bulider has been deleted');
  drupal_goto('admin/gavias_sliderlayer');
}

function gavias_sliderlayer_export($gid){
  $pbd_single = gavias_sliderlayer_load($gid);
  $data = $pbd_single->params;
  header("Content-Type: text/txt");
  header("Content-Disposition: attachment; filename=gavias_sliderlayer_export.txt");
  print $data;
  exit;
}

function gavias_sliderlayer_import($bid) {
  $bid = arg(2);
  if (is_numeric($bid)) {
    $bblock = \Drupal::database()->select('{gavias_sliderlayer}', 'd')
       ->fields('d')
       ->condition('id', $bid, '=')
       ->execute()
       ->fetchAssoc();
  } else {
    $bblock = array('id' => 0, 'title' => '');
  }

  if($bblock['id']==0){
    \Drupal::messenger()->addMessage('Not found gavias slider !');
    return false;
  }

  $form = array();
  $form['id'] = array(
      '#type' => 'hidden',
      '#default_value' => $bblock['id']
  );
  $form['params'] = array(
      '#type' => 'textarea',
      '#title' => 'Past code import for block builder "'.$bblock['title'].'"',
      '#default_value' => ''
  );
  $form['submit'] = array(
      '#type' => 'submit',
      '#value' => 'Save'
  );
  return $form;
}

function gavias_sliderlayer_import_submit($form, $form_state) {
  if ($form['id']['#value']) {
    $id = $form['id']['#value'];
    $builder = \Drupal::database()->update("gavias_sliderlayer")
      ->fields(array(
          'params' => $form['params']['#value'],
      ))
      ->condition('id', $id)
      ->execute();
    drupal_goto('admin/gavias_sliderlayer/'.$id.'/edit');
    \Drupal::messenger()->addMessage("Block Builder '{$form['title']['#value']}' has been updated");
  } 
}