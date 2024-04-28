<?php

/**
 * @file
 * Contains \Drupal\gavias_sliderlayer\Controller\GroupSliderController.
 */

namespace Drupal\gavias_sliderlayer\Controller;

use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use  Drupal\Core\Cache\Cache;

class SliderController extends ControllerBase {

  public function gavias_sl_sliders_list($gid){
  
    if(!\Drupal::database()->schema()->tableExists('gavias_sliderlayers')){
      return "";
    }

    $header = array( 'ID', 'Name', 'Action');
    
    $results = \Drupal::database()->select('{gavias_sliderlayers}', 'd')
            ->fields('d', array('id', 'title'))
            ->condition('group_id', $gid, '=')
            ->execute();
    $rows = array();

    foreach ($results as $row) {

      $tmp =  array();
      $tmp[] = $row->id;
      $tmp[] = $row->title;
      $tmp[] = t('<a href="@link_1">Edit Silder</a> | <a href="@link_2">Duplicate</a> | <a href="@link_3">Delete</a>', array(
          '@link_1' => Url::fromRoute('gavias_sl_sliders.admin.form', array('sid' => $row->id, 'gid' => $gid))->toString(),
          '@link_2' => Url::fromRoute('gavias_sl_sliders.admin.duplicate', array('id' => $row->id))->toString(),
          '@link_3' => Url::fromRoute('gavias_sl_group.admin.delete', array('sid' => $row->id, 'gid' => $gid, 'action' => 'slider'))->toString()
      ));
      $rows[] = $tmp;
    }
    return array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => t('No Slider available. <a href="@link">Add Slider</a>.', array('@link' => Url::fromRoute('gavias_sl_sliders.admin.form', array('sid'=>0, 'gid'=>$gid))->toString())),
    );
  }

  public function gavias_sl_sliders_edit($gid=0, $sid=0) {
   
    global $base_url;
    $page['#attached']['library'][] = 'gavias_sliderlayer/gavias_sliderlayer.assets.admin';
    $theme_name = \Drupal::config('system.theme')->get('default');
   
    $group = getSliderGroup($gid);
    $group_settings = (isset($group->params) && $group->params) ? base64_decode($group->params):'null';
    $group_settings_decode = (isset($group->params) && $group->params) ? json_decode(base64_decode($group->params)):'null';
    
    $sliderlayers = gavias_sliderlayer_load($sid);
    
    $layers = (isset($sliderlayers->layers) && $sliderlayers->layers) ? ($sliderlayers->layers) : 'null';
    //print"<pre>";print_r($layers); die();
    $settings = (isset($sliderlayers->settings) && $sliderlayers->settings) ? ($sliderlayers->settings):'null';
    
    $abs_url_save = Url::fromRoute('gavias_sl_sliders.admin.save', array(), array('absolute' => FALSE))->toString();
    $abs_url_edit = Url::fromRoute('gavias_sl_sliders.admin.form', array('gid'=>$gid, 'sid'=>$sid), array('absolute' => FALSE))->toString();

    $abs_url_config = Url::fromRoute('gavias_sliderlayer.admin.get_images_upload', array(), array('absolute' => FALSE))->toString();
    $page['#attached']['drupalSettings']['gavias_sliderlayer']['get_images_upload_url'] = $abs_url_config;
    $page['#attached']['drupalSettings']['gavias_sliderlayer']['base_path'] = base_path();
    $page['#attached']['drupalSettings']['gavias_sliderlayer']['base_url'] = $base_url;
    $page['#attached']['drupalSettings']['gavias_sliderlayer']['save_url'] = $abs_url_save;
    $page['#attached']['drupalSettings']['gavias_sliderlayer']['edit_url'] = $abs_url_edit;
    $page['#attached']['drupalSettings']['gavias_sliderlayer']['group_settings'] = $group_settings_decode;
    $page['#attached']['drupalSettings']['gavias_sliderlayer']['layers_settings'] = $layers;
    $page['#attached']['drupalSettings']['gavias_sliderlayer']['settings'] = $settings;
    $deslider = array(
      'title' => 'Slider',
      'status' => '1',
      'sort_index' => 1,
      'background_image_uri' => '',
      'background_image' => '',
      'background_position' => 'center top',
      'background_repeat' => 'no-repeat',
      'background_fit' => 'cover',
      'data_transition' => 'random',
      'slide_easing_in' => 'Power0.easeIn',
      'slide_easing_out' => 'Power1.easeOut',
      'delay' => '1000',
      'video_source' => '',
      'youtube_video' => '',
      'vimeo_video' => '',
      'html5_mp4'   => '',
      'mp4_nextslideatend' => 'true',
      'mp4_videoloop' => 'true',
      'video_youtube_args' => '&loop=1&autoplay=1&playlist=',
      'video_vimeo_args' => 'title=0&byline=0&portrait=0&api=1',
      'video_start_at' => '',
      'video_end_at' => '',
      'parallax_scroll' => 'off',
      'data_parallax'   => '8',
      'scalestart' => '0',
      'scaleend'  => '0'
    );

    $delayer = array(
      'index' => 10,
      'title' => '',
      'type' => 'text',
      'text' => 'Text Layer',
      'image' => '',
      'image_uri' => '',
      'fid' =>'',
      'top' => 0,
      'left' => 0,
      'data_time_start' => 500,
      'data_time_end' => 50000,
      'incomingclasses' => 'SlideMaskFromTop',
      'outgoingclasses' => 'Fade-Out',
      'data_speed' => 600,
      'data_end' => 600,
      'data_easing' => 'easeOutExpo',
      'data_endeasing' => 'Power0.easeIn',
      'removed' => 0,
      'width' => 200,
      'height' => 100,
      'custom_css' => '',
      'custom_style' => '',
      'select_content_type' => 'text',
      'font_size_lg' => '30',
      'font_size_sm' => '30',
      'font_size_xs' => '20',
      'line_height_lg'   => '38',
      'line_height_sm'   => '38',
      'line_height_xs'   => '28',
      'text_align_lg' => 'left',
      'text_align_sm' => 'left',
      'text_align_xs' => 'left',
    );

    $page['#attached']['drupalSettings']['gavias_sliderlayer']['deslider'] = $deslider;
    $page['#attached']['drupalSettings']['gavias_sliderlayer']['delayer'] = $delayer;
    
    $theme_name = \Drupal::config('system.theme')->get('default');
    $parent_name = $theme_name;
    $theme_handler = \Drupal::service('theme_handler');
    if($theme_handler->themeExists($theme_name)){
      $theme_handler = $theme_handler->getTheme($theme_name);
      $theme_info = $theme_handler->info;
      if(isset($theme_info['base theme']) && !empty($theme_info['base theme'])){
        $parent_name = $theme_info['base theme'];
      }
    }
    $path_theme = \Drupal::service('extension.list.theme')->getPath($parent_name);
    if(file_exists($path_theme . '/css/sliderlayer.css')){
      $style_fontend = $path_theme . '/css/sliderlayer.css';
    }else{
      $style_fontend = $path_theme . '/assets/css/sliderlayer.css';
    }
    
    ob_start();
    include GAV_SLIDERLAYER_PATH . '/templates/backend/slider.php';
    $content = ob_get_clean();
    $page['admin-form'] = array(
      '#theme' => 'admin-form',
      '#content' => $content
    );
    return $page;
  }

  public function gavias_sliderlayer_save(){
    header('Content-type: application/json');
    $gid = $_REQUEST['gid'];
    $sid = $_REQUEST['sid'];
    $title = $_REQUEST['title'];
    $sort_index = $_REQUEST['sort_index'];
    $status = $_REQUEST['status'];
    $settings = $_REQUEST['settings'];

    $datalayers = $_REQUEST['datalayers'];
    $background_image_uri = $_REQUEST['background_image_uri'];
    if($sid > 0){
      $builder = \Drupal::database()->update("gavias_sliderlayers")
          ->fields(array(
            ' sort_index' => $sort_index,
            'status' => $status,
            'title' => $title,
            'params'  => $settings,
            'layersparams' => $datalayers,
            'background_image_uri' => $background_image_uri
          ))
          ->condition('id', $sid, '=')
          ->execute();
      
      $abs_url_edit = Url::fromRoute('gavias_sl_sliders.admin.form', array('gid'=>$gid, 'sid'=>$sid), array('absolute' => TRUE))->toString();
      $result = array(
        'data' => 'insert saved',
        'action' => 'edit',
        'url_edit'  => $abs_url_edit
      );
    }else{
    $sid = $builder = \Drupal::database()->insert("gavias_sliderlayers")
            ->fields(array(
                'sort_index' => $sort_index,
                'status' => $status,
                'title' => $title,
                'group_id' => $gid,
                'params'  => $settings,
                'layersparams' => $datalayers,
                'background_image_uri' => $background_image_uri
            ))
            ->execute();
    $abs_url_edit = Url::fromRoute('gavias_sl_sliders.admin.form', array('gid'=>$gid, 'sid'=>$sid), array('absolute' => TRUE))->toString();
     $result = array(
        'data' => 'insert saved',
        'sid'  => $sid,
        'gid'  => $gid,
        'action' => 'add',
        'url_edit'  => $abs_url_edit
    );
    \Drupal::messenger()->addMessage("SliderLayers has been created");
  }
  // Clear all cache
  \Drupal::service('plugin.manager.block')->clearCachedDefinitions();     
  foreach (Cache::getBins() as $service_id => $cache_backend) {
    if($service_id == 'render' || $service_id == 'page'){
      $cache_backend->deleteAll();
    }
  }
  print json_encode($result);
  exit(0);
  }

 
  public function gavias_upload_file(){
    // A list of permitted file extensions
    global $base_url;
    $allowed = array('png', 'jpg', 'gif','zip');
    $_id = gavias_sliderlayer_makeid(6);
    $file_default_scheme = \Drupal::config('system.file')->get('default_scheme');

    if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

      $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

      if(!in_array(strtolower($extension), $allowed)){
        echo '{"status":"error extension"}';
        exit;
      }  
      $path_folder = \Drupal::service('file_system')->realpath($file_default_scheme. "://gva-slider-upload");
    
      $file_path = $path_folder . '/' . $_id . '-' . $_FILES['upl']['name'];
      $file_url = str_replace($base_url, '',\Drupal::service('file_url_generator')->generateAbsoluteString($file_default_scheme. "://gva-slider-upload") . '/' .  $_id .'-'. $_FILES['upl']['name']); 
      if (!is_dir($path_folder)) {
       @mkdir($path_folder); 
      }
      if(move_uploaded_file($_FILES['upl']['tmp_name'], $file_path)){
        $result = array(
          'file_url' => $file_url,
          'file_url_full' => $base_url . $file_url
        );
        print json_encode($result);
        exit;
        }
    }

    echo '{"status":"error"}';
    exit;

  }

}
