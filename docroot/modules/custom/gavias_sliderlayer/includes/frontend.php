<?php
function gavias_sliderlayer_block_content($sid) {
  global $base_url;
  $slideshow = gavias_slider_load_frontend($sid);
  if(!$slideshow) return 'No slider selected';
  $module_path = \Drupal::service('extension.list.module')->getPath('gavias_sliderlayer');

  //Setting 
  $settings = $slideshow->settings;

  $ss = new stdClass();
  $ss->delay = isset($settings->delay) ? (int)$settings->delay : 9000;
  $gridheight = isset($settings->gridheight) ? (int)$settings->gridheight : 600;
  $ss->gridheight_2 = isset($settings->gridheight) ? '[' . (int)$settings->gridheight . ']': '[600]';
  $gridheight_sm = isset($settings->gridheight_sm) ? (int)$settings->gridheight_sm : false;
  $gridheight_xs = isset($settings->gridheight_xs) ? (int)$settings->gridheight_xs : false;
  $ss->gridwidth = isset($settings->gridwidth) ? (int)$settings->gridwidth : 1170;
  $ss->gridwidth_2 = isset($settings->gridwidth) ? '[' . (int)$settings->gridwidth . ']' : '[1170]';
  $ss->gridheight = $gridheight;
  $ss->reponsive = false;
  $ss->responsiveLevels = "[1240,1024,778,778]";
  if($gridheight_sm || $gridheight_xs){
    if(!$gridheight_sm) $gridheight_sm = $gridheight;
    if($gridheight_xs) $ss->responsiveLevels = '[1240,1024,778,480]';
    if(!$gridheight_xs) $gridheight_xs = $gridheight_sm;
    $ss->gridheight = $ss->gridheight_2 = "[{$gridheight},{$gridheight_sm},{$gridheight_sm},{$gridheight_xs}]";
    $ss->gridwidth = $ss->gridwidth_2 = '[1170,1024,778,480]';
    $ss->reponsive = true;
  }

  $ss->minHeight = isset($settings->minheight) ? (int)$settings->minheight : 0;
  $ss->autoHeight = 'off';
  $ss->sliderType = "standard";
  $ss->sliderLayout = isset($settings->sliderlayout) ? $settings->sliderlayout : 'auto';  // auto, fullwidth, fullscreen      
  $ss->fullScreenAlignForce="off";
  $ss->fullScreenOffsetContainer="";      
  $ss->fullScreenOffset="0";
  $ss->hideCaptionAtLimit=0;               
  $ss->hideAllCaptionAtLimit=0;            
  $ss->hideSliderAtLimit=0;                                    
  $ss->disableProgressBar= isset($settings->progressbar_disable) ? $settings->progressbar_disable : "on";             
  $ss->stopAtSlide=-1;                    
  $ss->stopAfterLoops=-1;                  
  $ss->shadow= isset($settings->shadow) ? $settings->shadow : 0;                       
  $ss->dottedOverlay = isset($settings->dottedOverlay) ? $settings->dottedOverlay : 'none';        
  $ss->startDelay=0;                                
  $ss->lazyType = "none";                
  $ss->spinner = "spinner0";
  $ss->shuffle = "off"; 
  $ss->debugMode = 0;
  //print "<pre>"; print_r($settings); die();

  $ss->parallax = new stdClass();
  $ss->parallax->type = 'off';

  if(isset($settings->parallax_scroll)){
    if($settings->parallax_scroll == 'mouse+scroll'){
      $ss->parallax->type = 'mouse+scroll';
      $ss->parallax->bgparallax = 'on';
    }
  }

  $ss->navigation = new stdClass();

  $ss->navigation->onHoverStop = isset($settings->onhoverstop) ? $settings->onhoverstop : 'on';

  $ss->navigation->touch = new stdClass();
  $ss->navigation->touch->touchenabled = 'on';

  $ss->navigation->arrows = new stdClass();
  $ss->navigation->arrows->enable = (isset($settings->arrow_enable) && $settings->arrow_enable =='true') ? 'true' : 'false';

  $ss->navigation->arrows->left = new stdClass();
  $ss->navigation->arrows->left->h_align = isset($settings->navigationLeftHAlign) ? $settings->navigationLeftHAlign : 'left';
  $ss->navigation->arrows->left->v_align = isset($settings->navigationLeftVAlign) ? $settings->navigationLeftVAlign : 'center';
  $ss->navigation->arrows->left->h_offset = isset($settings->navigationLeftHOffset) ? (int)$settings->navigationLeftHOffset : 0;
  $ss->navigation->arrows->left->v_offset = isset($settings->navigationLeftVOffset) ? (int)$settings->navigationLeftVOffset : 20;

  $ss->navigation->arrows->right = new stdClass();
  $ss->navigation->arrows->right->h_align = isset($settings->navigationRightHAlign) ? $settings->navigationRightHAlign : 'right';
  $ss->navigation->arrows->right->v_align = isset($settings->navigationRightVAlign) ? $settings->navigationRightVAlign : 'center';
  $ss->navigation->arrows->right->h_offset = isset($settings->navigationRightHOffset) ? (int)$settings->navigationRightHOffset : 0;
  $ss->navigation->arrows->right->v_offset = isset($settings->navigationRightVOffset) ? (int)$settings->navigationRightVOffset : 20;

  $ss->navigation->bullets = new stdClass();
  $ss->navigation->bullets->enable = (isset($settings->bullets_enable) && $settings->bullets_enable =='true') ? 'true' : 'false';
  $ss->navigation->bullets->v_align = 'bottom';
  $ss->navigation->bullets->h_align = 'center';
  $ss->navigation->bullets->v_offset = 20;
  $ss->navigation->bullets->space = 10;
  $ss->navigation->bullets->tmp = '';
  
  $ss->parallax = new stdClass();
  $ss->parallax->type = "mouse";
  $ss->parallax->origo = "slidercenter";
  $ss->parallax->speed = 2000;
  $ss->parallax->levels = [4,5,6,7,12,16,10,50,46,47,48,49,50,55];

    //gridwidth:[1170,1170,778,480],
    //gridheight:[700,700,500,400],

  $ss = json_encode($ss);
  $ss_settings = json_encode($settings);

  $slide_settings['id'] = $sid;
  $slide_settings['slides'] = $slideshow->slides;
  $slide_settings['settings'] = $slideshow->settings;

  $slide_settings['scount'] = count($slideshow->slides);

  $slide_settings['ss'] = $ss;
  $slide_settings['ss_settings'] = $ss_settings;

  return gavias_sliderlayer_slides($slide_settings);

}

function gavias_sliderlayer_slides($vars){
  global $base_url;
  $slides = $vars['slides'];
  $scount = $vars['scount'];
  $settings = $vars['settings'];
  $vars['attributes_array']['class'] = 'gavias_sliderlayer rev_slider_wrapper fullwidthbanner-container';
  $style = array();
  $style[] = 'height:'. ((isset($settings->gridheight) && $settings->gridheight) ? $settings->gridheight : '700') . 'px';
  $vars['attributes_array']['style'] = implode(';', $style);
  
  $vars['content'] = '';
  $i = 1;
  foreach($slides as $slide){
    if($slide->status){
      $slide_settings['slide'] = $slide;
      $slide_settings['scount'] = $scount;
      $slide_settings['settings'] = $settings;
      $slide_settings['sid'] = $vars['id'];
      $vars['content'] .= gavias_sliderlayer_slide($slide_settings, $i);
      $i = $i + 1;
    }  
  }

  $vars['attributes'] = '';
  foreach($vars['attributes_array'] as $key => $attr){
    $vars['attributes'] .= $key . '=' . '"' . $attr . '" ';
  }

  extract($vars);
  ob_start();
    include GAV_SLIDERLAYER_PATH . '/templates/frontend/slides.php';
  $output = ob_get_clean();
  return $output;
}

function gavias_sliderlayer_slide($vars, $index){
  global $base_url;
  $module_path = \Drupal::service('extension.list.module')->getPath('gavias_sliderlayer');
  $slide = $vars['slide'];
  $layers = $slide->layers;
  $scount =  $vars['scount'];
  $settings = $vars['settings'];
  $vars['attributes_array']['data-transition'] = $slide->data_transition;
  $vars['attributes_array']['data-easein'] = $slide->slide_easing_in;
  $vars['attributes_array']['data-easeout'] = $slide->slide_easing_out;
  $vars['attributes_array']['data-slotamount'] = 'default';
  $vars['attributes_array']['data-kenburns'] = 'off';
  $vars['attributes_array']['data-masterspeed'] = '800';
  $vars['attributes_array']['data-index'] = 'rs-' . $index;
  $vars['attributes_array']['data-saveperformance'] = 'off';

  if(isset($slide->overlay_enable) && $slide->overlay_enable=='on'){
    $vars['attributes_array']['class'] = 'gavias-overlay ';
  }

  if(!isset($slide->scalestart)){$slide->scalestart=0;}
  if(!isset($slide->scaleend)){$slide->scaleend=0;}
  if(!isset($slide->data_parallax)){$slide->data_parallax=0;}
  if(!$slide->background_color){$slide->background_color='#f2f2f2';}
  $data_kenburns = 'off';
  if(isset($slide->scalestart) && $slide->scalestart && $slide->scalestart != 0){
    $data_kenburns = 'on';
  }
  $path_image = substr(base_path(), 0, -1);
  if(!isset($slide->delay)) $slide->delay = 400;
  if($slide->background_image_uri){
    $vars['content'] = "<img class=\"rev-slidebg\" src=\"{$path_image}{$slide->background_image_uri}\" alt=\"\"  data-bgcolor=\"#fff\" data-duration=\"{$slide->delay}\" data-bgparallax=\"{$slide->data_parallax}\"  data-scalestart=\"{$slide->scalestart}\" data-scaleend=\"{$slide->scaleend}\" data-kenburns=\"{$data_kenburns}\"  data-bgrepeat=\"{$slide->background_repeat}\" style=\"background-color:{$slide->background_color}\" data-bgfit=\"{$slide->background_fit}\" data-bgposition=\"{$slide->background_position}\" />";
  }else{
    $vars['content'] = "<img class=\"rev-slidebg\" src=\"{$path_image}/{$module_path}/vendor/revolution/assets/transparent.png\" data-bgcolor=\"#fff\" data-bgrepeat=\"repeat\" style=\"background-color:{$slide->background_color}\" />";
  }
  $zindex = count($layers) + 1;
  $layer_count = 1;
  $slide_id = $slide->id;
  foreach($layers as $layer){
    $layer_settings['layer'] = $layer;
    $layer_settings['zindex'] = $zindex--;
    $layer_settings['scount'] = $scount;
    $layer_settings['settings'] = $settings;
    $vars['content'] .= gavias_sliderlayer_layer($layer_settings, $layer_count, $slide_id);
    $layer_count ++;
  }

  $vars['attributes'] = '';
  foreach($vars['attributes_array'] as $key => $attr){
    $vars['attributes'] .= $key . '=' . '"' . $attr . '" ';
  }


  // Array
  $vars['attributes_video_array'] = array();
  if(isset($slide->video_source) && (isset($slide->youtube_video) || isset($slide->vimeo_video) || isset($slide->html5_mp4))){
    if($slide->video_source &&($slide->youtube_video || $slide->vimeo_video || $slide->html5_mp4)){
      $vars['attributes_video_array']['data-forcerewind'] = 'on';
      $vars['attributes_video_array']['data-volume'] = 'mute';
      if(!isset($slide->video_youtube_args) && empty($slide->video_youtube_args)){
        $slide->video_youtube_args = 'version=3&enablejsapi=1&html5=1&hd=1&wmode=opaque&showinfo=0&ref=0;autoplay=1;';
      }
      if(!isset($slide->video_vimeo_args) && empty($slide->video_vimeo_args)){
        $slide->video_vimeo_args = 'title=0&byline=0&portrait=0&api=1';
      }
      if($slide->video_source == 'youtube'){
        $vars['attributes_video_array']['data-videoattributes'] = $slide->video_youtube_args;
      }
      if($slide->video_source == 'vimeo'){
        $vars['attributes_video_array']['data-videoattributes'] = $slide->video_vimeo_args;
      }
      if($slide->video_source == 'html5'){
        $vars['attributes_video_array']['data-nextslideatend'] = isset($slide->mp4_nextslideatend) ? $slide->mp4_nextslideatend : true;
        $vars['attributes_video_array']['data-videoloop'] = isset($slide->mp4_videoloop) ? $slide->mp4_videoloop : 'loopandnoslidestop';
      }
      $vars['attributes_video_array']['data-videorate'] = '1';
      $vars['attributes_video_array']['data-videowidth'] = '100%';
      $vars['attributes_video_array']['data-videoheight'] = '100%';
      $vars['attributes_video_array']['data-videocontrols'] = 'none';
      if($slide->video_source == 'youtube' && $slide->youtube_video){
        $vars['attributes_video_array']['data-ytid'] = $slide->youtube_video;
      }
      if($slide->video_source == 'vimeo' && $slide->vimeo_video){
        $vars['attributes_video_array']['data-vimeoid'] = $slide->vimeo_video;
      }
      if($slide->video_source == 'html5' && $slide->html5_mp4){
        $vars['attributes_video_array']['data-videomp4'] = $slide->html5_mp4;
      }
      if(isset($slide->video_start_at) && $slide->video_start_at){
        $vars['attributes_video_array']['data-videostartat'] = $slide->video_start_at;
      }
      if(isset($slide->video_end_at) && $slide->video_end_at){
        $vars['attributes_video_array']['data-videoendat'] = $slide->video_end_at;
      }
      //$vars['attributes_video_array']['data-videoloop'] = 'loopandnoslidestop';
      $vars['attributes_video_array']['data-forceCover'] = '1';
      $vars['attributes_video_array']['data-aspectratio'] = '16:9';
      $vars['attributes_video_array']['data-autoplay'] = 'true';
      $vars['attributes_video_array']['data-autoplayonlyfirsttime'] = 'false';
      //$vars['attributes_video_array']['data-nextslideatend'] = 'false';

      $vars['attributes_video_array']['class'] = 'rs-background-video-layer';

      $vars['attributes_video'] = '';
      foreach($vars['attributes_video_array'] as $key => $attr){
        $vars['attributes_video'] .= $key . '=' . '"' . $attr . '" ';
      }
    }
  }


  extract($vars);
  ob_start();
    include GAV_SLIDERLAYER_PATH . '/templates/frontend/slide.php';
  $output = ob_get_clean();
  return $output;
}

function gavias_sliderlayer_layer($vars, $layer_count, $slider_id){
  global $base_url;
  $module_path = \Drupal::service('extension.list.module')->getPath('gavias_sliderlayer');
  $layer = $vars['layer'];
  $scount = $vars['scount'];
  $settings = $vars['settings'];
  $layer_id = "slide-{$slider_id}-layer-{$layer_count}";
  $vars['attributes_array']['class'] = 'tp-caption tp-resizeme ';
  $vars['attributes_array']['data-paddingtop'] = '[0,0,0,0]'; 
  $vars['attributes_array']['data-paddingright'] = '[0,0,0,0]'; 
  $vars['attributes_array']['data-paddingbottom'] = '[0,0,0,0]'; 
  $vars['attributes_array']['data-paddingleft'] = '[0,0,0,0]'; 
  $vars['attributes_array']['data-voffset'] = '[0,0,0,0]'; 
  $vars['attributes_array']['data-hoffset'] = '[0,0,0,0]';
  if($layer->type=='text'){
    $vars['attributes_array']['class'] .= $layer->text_style . ' ';
  }
  if(isset($layer->custom_class) && $layer->custom_class){
    $vars['attributes_array']['class'] .= $layer->custom_class . ' ';
  }
  if(isset($layer->custom_style) && $layer->custom_style){
    $vars['attributes_array']['class'] .= $layer->custom_style . ' ';
  }
  
  if(is_numeric($layer->left)) $layer->left = round($layer->left);
  if(is_numeric($layer->top)) $layer->top = round($layer->top);

  $vars['attributes_array']['data-x'] = $layer->left;
  $vars['attributes_array']['data-y'] = $layer->top;

  $gridheight_sm = isset($settings->gridheight_sm) ? (int)$settings->gridheight_sm : false;
  $gridheight_xs = isset($settings->gridheight_xs) ? (int)$settings->gridheight_xs : false;
  $left_sm = isset($layer->left_sm) ? $layer->left_sm : false;
  $left_xs = isset($layer->left_xs) ? $layer->left_xs : false;
  if(is_numeric($left_sm)) $left_sm = round($left_sm);
  if(is_numeric($left_xs)) $left_sm = round($left_xs);

  if($gridheight_sm || $gridheight_xs || $left_sm || $left_xs){
    if(!$left_xs) $left_xs = $left_sm;
    if(!$left_sm & !$left_xs) $left_sm = $left_xs = $layer->left;
    $data_x = "['{$layer->left}','{$layer->left_sm}','{$left_sm}','{$left_xs}']";
    $vars['attributes_array']['data-x'] = $data_x;
  }

  $top_sm = isset($layer->top_sm) ? $layer->top_sm : false;
  $top_xs = isset($layer->top_xs) ? $layer->top_xs : false;
   if(is_numeric($top_sm)) $top_sm = round($top_sm);
  if(is_numeric($top_xs)) $left_sm = round($top_xs);
  if($gridheight_sm || $gridheight_xs || $top_sm || $top_xs){
    if(!$top_xs && is_numeric($top_sm)) $top_xs = round($top_sm);
    if(!$top_sm & !$top_xs) $top_sm = $top_xs = round($layer->top);
    $data_y = "['{$layer->top}', '{$top_sm}', '{$top_sm}', '{$top_xs}']";
    $vars['attributes_array']['data-y'] = $data_y;
  }

  //$vars['attributes_array']['data-start'] = $layer->data_time_start;
 
  $settings_delay = (isset($settings->delay) && $settings->delay) ? $settings->delay : 9000;

  // Font size
  $data_font_size = $font_size_lg = (isset($layer->font_size_lg) && $layer->font_size_lg) ? $layer->font_size_lg : false;
  $font_size_sm = (isset($layer->font_size_sm) && $layer->font_size_sm) ? $layer->font_size_sm : false;
  $font_size_xs = (isset($layer->font_size_xs) && $layer->font_size_xs) ? $layer->font_size_xs : false;
  if(!$font_size_sm) $font_size_sm = $font_size_lg;
  if(!$font_size_xs) $font_size_xs = $font_size_sm;
  if(($gridheight_sm || $gridheight_xs) && $font_size_lg){
    $data_font_size = "['{$font_size_lg}','{$font_size_sm}','{$font_size_sm}','{$font_size_xs}']";
  }
  if($data_font_size) $vars['attributes_array']['data-fontsize'] = $data_font_size;

  // Line Height
  $data_line_height = $line_height_lg = (isset($layer->line_height_lg) && $layer->line_height_lg) ? $layer->line_height_lg : false;
  $line_height_sm = (isset($layer->line_height_sm) && $layer->line_height_sm) ? $layer->line_height_sm : false;
  $line_height_xs = (isset($layer->line_height_xs) && $layer->line_height_xs) ? $layer->line_height_xs : false;
  if(!$line_height_sm) $line_height_sm = $line_height_lg;
  if(!$line_height_xs) $line_height_xs = $line_height_sm;
  if(($gridheight_sm || $gridheight_xs) && ($line_height_lg)){
     $data_line_height = "['{$line_height_lg}','{$line_height_sm}','{$line_height_sm}','{$line_height_xs}']";
  }
  if($data_line_height) $vars['attributes_array']['data-lineheight'] = $data_line_height; 

  // Color
  $color_lg = (isset($layer->color_lg) && $layer->color_lg) ? $layer->color_lg : false;
  $color_sm = (isset($layer->color_sm) && $layer->color_sm) ? $layer->color_sm : false;
  $color_xs = (isset($layer->color_xs) && $layer->color_xs) ? $layer->color_xs : false;

  $color_lg = sliderlayer_hexToRgb($color_lg);
  $color_sm = sliderlayer_hexToRgb($color_sm);
  $color_xs = sliderlayer_hexToRgb($color_xs);
  if(!$color_sm) $color_sm = $color_lg;
  if(!$color_xs) $color_xs = $color_sm;

  $data_color = '';
  if($color_lg){
    $data_color = "['{$color_lg}','{$color_lg}','{$color_lg}','{$color_lg}']";
  }
  if(($gridheight_sm || $gridheight_xs) && $color_lg){
     $data_color = "['{$color_lg}','{$color_sm}','{$color_sm}','{$color_xs}']";
  }
  if($data_color) $vars['attributes_array']['data-color'] = $data_color; 

    // Font Weight
  $data_text_align = $text_align_lg = (isset($layer->text_align_lg) && $layer->text_align_lg) ? $layer->text_align_lg : false;
  $text_align_sm = (isset($layer->text_align_sm) && $layer->text_align_sm) ? $layer->text_align_sm : false;
  $text_align_xs = (isset($layer->text_align_xs) && $layer->text_align_xs) ? $layer->text_align_xs : false;
  if(!$text_align_sm) $text_align_sm = $text_align_lg;
  if(!$text_align_xs) $text_align_xs = $text_align_sm;
  if(($gridheight_sm || $gridheight_xs) && $text_align_lg){
    if(!$text_align_sm) $text_align_sm = $text_align_lg;
    if(!$text_align_xs) $text_align_xs = $text_align_sm;
     $data_line_height = "['{$text_align_lg}','{$text_align_sm}','{$text_align_sm}','{$text_align_xs}']";
  }
  if($data_text_align) $vars['attributes_array']['data-textalign'] = $data_text_align; 

  //$vars['attributes_array']['data-voffset'] = "['0','0','0','0']";
  //$vars['attributes_array']['data-hoffset'] = "['0','0','0','0']";
  $vars['attributes_array']['data-responsive_offset'] = 'on';

 // $vars['attributes_array']['data-transform_idle'] ="o:1;";
  $frames = array();

  $transform_in = '';
  $mask_in = '';
  if($layer->incomingclasses){
    $tmp = gaviasGetArrAnimations()[$layer->incomingclasses];
    if($tmp){
      $params = (array)$tmp['params'];
      if(isset($params['split']) && $params['split'] && $params['split'] != 'none') {
        $frames[0]['split'] = $params['split'];
        $frames[0]['splitdelay'] = 0.1;
      }
      $transform_in = parseCustomAnimationByArray($params);

      if(isset($params['mask']) && $params['mask']==true){
        $mask_in = parseCustomMaskByArray($params, 'start');
      }

    }  
  }

    $frames[0]['delay'] = round($layer->data_time_start);
    $frames[0]['speed'] = $layer->data_speed;
    $frames[0]['frame'] = 0;
    $frames[0]['from'] = $transform_in;
    if($mask_in) $frames[0]['mask'] = $mask_in;
    $frames[0]['ease'] = $layer->data_easing;




  $transform_out = '';
  $mask_out = '';
  if($layer->outgoingclasses){
    $tmp_out = gaviasGetArrEndAnimations()[$layer->outgoingclasses];
    if($tmp_out){
      $params_out = (array)$tmp_out['params'];
      $transform_out = parseCustomAnimationByArray($params_out, 'end');
      if(isset($params['mask']) && $params['mask']==true){
        $mask_out = parseCustomMaskByArray($params_out, 'end');
      }
    }else{
      $transform_out .= 'auto:auto;';
    } 
  }

//print $transform_out;
  $frames[1] = array(
    'delay' => 'wait',
    'speed' => $layer->data_end,
    'frame' => 999,
    'to'    => $transform_out ? $transform_out : 'auto:auto;',
    'ease'  => $layer->data_endeasing ? $layer->data_endeasing : 'nothing'
  );

  if($mask_out) $frames[1]['mask'] = $mask_out;

  if( ((int)$layer->data_time_end + 20) < $settings_delay && ((int)$layer->data_time_end > (int)$layer->data_time_start)){
    $vars['attributes_array']['data-end'] = round($layer->data_time_end);
     $frames[1]['delay'] = round($layer->data_time_end);
  }  

  $data_frames = json_encode($frames);

  if($layer->custom_css){
    $custom_css = trim(preg_replace('/\s+/', ' ', $layer->custom_css));
    $vars['attributes_array']['style'] = 'z-index:'.$vars['zindex'].';'.$custom_css;
  }else{
    $vars['attributes_array']['style'] = 'z-index:'.$vars['zindex'];
  }
  if($layer->incomingclasses == 'customin'){
    $vars['attributes_array']['data-customin'] = $layer->customin;
  }
  if($layer->outgoingclasses == 'customout'){
    $vars['attributes_array']['data-customout'] = $layer->customout;
  }  

  switch($layer->type){
    case 'text':
      if($layer->link){
        $vars['content'] =  "<a href=\"{$layer->link}\">{$layer->text}</a>";
      }else{
        $vars['content'] = $layer->text;
      }
      break;
    case 'image':
      $width = $layer->width;
      $height = $layer->height;

      $data_width = $width_lg = (isset($layer->width) && $layer->width) ? $layer->width : false;
      $width_sm = (isset($layer->width_sm) && $layer->width_sm) ? $layer->width_sm : false;
      $width_xs = (isset($layer->width_xs) && $layer->width_xs) ? $layer->width_xs : false;
      if(!$width_sm) $width_sm = $width_lg;
      if(!$width_xs) $width_xs = $width_sm;
      if(($gridheight_sm || $gridheight_xs) && $data_width){
        $vars['attributes_array']['data-width'] = "['{$width_lg}','{$width_lg}','{$width_sm}','{$width_xs}']";
      }
      $vars['attributes_array']['data-height'] = "['auto','auto','auto','auto']";

      $image = $layer->image;
      $path_image = substr(base_path(), 0, -1);
      if($layer->link){
        $vars['content'] = "<a href=\"{$layer->link}\"><img alt=\"\" src=\"{$path_image}{$image}\"/></a>";
      }else{
        //$vars['content'] = "<div class=\"layer-style-image\" style=\"width: {$width}px; height: auto;\"><img alt=\"\" src=\"{$path_image}{$image}\"/></div>";
        $vars['content'] = "<img alt=\"\" src=\"{$path_image}{$image}\"/>";
      }
      break;
  }
    $vars['attributes'] = '';
    foreach($vars['attributes_array'] as $key => $attr){
      $vars['attributes'] .= $key . '=' . '"' . $attr . '" ';
    }

    extract($vars);
    ob_start();
      include GAV_SLIDERLAYER_PATH . '/templates/frontend/layer.php';
    $output = ob_get_clean();
    return $output;
}


function sliderlayer_HexToRgb($hex) {
  if(empty($hex)) return false;
  $hex      = str_replace('#', '', $hex);
  $split = str_split($hex, 2);
  $r = hexdec($split[0]);
  $g = hexdec($split[1]);
  $b = hexdec($split[2]);
  return "rgb({$r},{$g},{$b})";
}
