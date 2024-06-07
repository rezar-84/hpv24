<?php 

if(!class_exists('element_gva_call_to_action')):
   class element_gva_call_to_action{
      public function render_form(){
         $fields = array(
            'type' => 'gsc_call_to_action',
            'title' => t('Call to Action'),
            'fields' => array(
               array(
                  'id'        => 'sub_title',
                  'type'      => 'text',
                  'title'     => t('Sub Title'),
                  'class'     => 'width-1-3'
               ),
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'admin'     => true,
                  'class'     => 'width-1-3'
               ),
               array(
                  'id'        => 'icon',
                  'type'      => 'text',
                  'title'     => t('Icon class'),
                  'class'     => 'width-1-3'
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content'),
                  'desc'      => t('HTML tags allowed.'),
               ),
               array(
                 'id'        => 'info',
                 'type'      => 'info',
                 'title'      => 'Style & Colors'
               ),
               array(
                  'id'           => 'button_align',
                  'type'         => 'select',
                  'title'        => 'Style',
                  'options'      => array(
                     ' '                        => t('Defaut'),
                     'button-left'              => t('Button Left'),
                     'button-right'             => t('Button Right'),
                     'button-bottom'            => t('Button Bottom Left'),
                     'button-bottom-right'      => t('Button Bottom Right'),
                     'button-center'            => t('Button Bottom Center')
                  ),
                  'class'     => 'width-1-4'
               ),
               array(
                  'id'        => 'subtitle_color',
                  'type'      => 'select',
                  'title'     => 'Sub Title Color',
                  'options'   => array(
                     ''             => '-- Default --',
                     'text-gray'    => 'Gray Color',
                     'text-light'   => 'Gray Light Color',
                     'text-black'   => 'Black Color',
                     'text-white'   => 'White Color',
                     'text-theme'   => 'Theme Color'
                  ),
                  'class'     => 'width-1-4'
               ),
               array(
                  'id'        => 'title_color',
                  'type'      => 'select',
                  'title'     => 'Title Color',
                  'options'   => array(
                     ''             => '-- Default --',
                     'text-gray'    => 'Gray Color',
                     'text-light'   => 'Gray Light Color',
                     'text-black'   => 'Black Color',
                     'text-white'   => 'White Color',
                     'text-theme'   => 'Theme Color'
                  ),
                  'class'     => 'width-1-4'
               ),
               array(
                  'id'        => 'desc_color',
                  'type'      => 'select',
                  'title'     => 'Description Color',
                  'options'   => array(
                     ''             => '-- Default --',
                     'text-gray'    => 'Gray Color',
                     'text-light'   => 'Gray Light Color',
                     'text-black'   => 'Black Color',
                     'text-white'   => 'White Color',
                     'text-theme'   => 'Theme Color'
                  ),
                  'class'     => 'width-1-4'
               ),

               array(
                 'id'        => 'info',
                 'type'      => 'info',
                 'title'      => 'Settings Button'
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
                  'class'     => 'width-1-3'
               ),
               array(
                  'id'        => 'button_title',
                  'type'      => 'text',
                  'title'     => t('Button Title'),
                  'class'     => 'width-1-3'
               ),
               
               array(
                  'id'        => 'target',
                  'type'      => 'select',
                  'title'     => t('Open in new window'),
                  'desc'      => t('Adds a target="_blank" attribute to the link'),
                  'options'   => array( 'off' => 'Off', 'on' => 'On' ),
                  'class'     => 'width-1-3'
               ),
               array(
                  'id'        => 'style_button',
                  'type'      => 'select',
                  'title'     => 'Style button',
                  'options'   => array(
                     'btn-theme'    => 'Button Theme',
                     'btn-white'    => 'Button White',
                     'btn-black'    => 'Button Black',
                     'btn-inline'   => 'Button Inline'
                  ),
                  'default'    => '',
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'skin',
                  'type'      => 'select',
                  'title'     => 'Layout',
                  'options'   => array(
                     'skin-v1'    => 'Skin v1',
                     'skin-v2'    => 'Skin v2',
                     'skin-v3'    => 'Skin v3',
                  ),
                  'default'    => '',
                  'class'     => 'width-1-2'
               ),
               array(
                 'id'        => 'info',
                 'type'      => 'info',
                 'title'      => 'Settings Video Link'
               ),
               array(
                  'id'        => 'link_video',
                  'type'      => 'text',
                  'title'     => t('Link Video (youtube/vimeo)')
               ),
              
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
                  'class'     => 'width-1-3'
               ),
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => t('Animation'), 
                  'desc'      => t('Entrance animation for element'),
                  'options'   => gavias_content_builder_animate(),
                  'class'     => 'width-1-3'
               ), 
               array(
                  'id'        => 'animate_delay',
                  'type'      => 'select',
                  'title'     => t('Animation Delay'),
                  'options'   => gavias_content_builder_delay_wow(),
                  'desc'      => '0 = default',
                  'class'     => 'width-1-3'
               ), 
            ),                                       
         );
      return $fields;
      }

      function render_content( $attr = array(), $content = ''  ){
         extract(gavias_merge_atts(array(
            'title'           => '',
            'sub_title'       => '',
            'icon'            => '',
            'content'         => '',
            'button_align'    => '',
            'font_size'       => '00',
            'font_weight'     => 'fw-700',
            'title_color'     => '',
            'subtitle_color'  => '',
            'desc_color'      => '',
            'link'            => '',
            'button_title'    => '',
            'style_button'    => 'btn-theme',
            'skin'            => 'skin-v1',
            'link_video'      => '',
            'target'          => '',
            'el_class'        => '',
            'animate'         => '',
            'animate_delay'   => '',
            'max_width'       => '',
            'box_background'  => '',
            'video'           => ''
         ), $attr));
         
         // target
         if( $target =='on' ){
            $target = 'target="_blank"';
         } else {
            $target = false;
         }
         
         $class = array();
         $class[] = $skin;
         $class[] = $el_class;
         $class[] = $button_align;
         if($animate) $class[] = 'wow ' . $animate; 
         if($box_background) $class[] = 'has-background';


         $style = '';
         if($max_width) $style .= "max-width: {$max_width};";
         if($box_background) $style .= "background: {$box_background};";
         $style = !empty($style) ? "style=\"".$style ."\"" : '';

         $link = gavias_get_uri($link);
         ob_start();
         ?>

         <div class="widget gsc-call-to-action <?php print implode(' ', $class) ?>" <?php print $style ?> <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
            <div class="content" >
               <div class="content-inner">
                  <div class="content-box">
                     <?php if($link_video){ ?>
                        <div class="video-inner"><a class="popup-video link-video" href="<?php print $link_video ?>"><i class="fa fa-play"></i></a></div>
                     <?php } ?> 
                     <?php 
                        if($icon){ 
                           print '<div class="icon-inner">';
                           if($icon){ 
                              print '<span class="icon ' . $icon . '"></span>';
                           } 
                           print '</div>';
                        } 
                     ?>

                     <div class="content-right">
                        <?php if($sub_title){ ?><div class="sub-title <?php print $subtitle_color; ?>"><span><?php print $sub_title; ?></span></div><?php } ?>
                        <h2 class="title fsize-<?php print $font_size ?> <?php print $font_weight ?> <?php print $title_color; ?>"><span><?php print $title; ?></span></h2>
                        <div class="desc <?php print $desc_color; ?>"><?php print $content; ?></div>
                     </div>
                  </div>
                  <div class="button-action">
                     <?php if($link){?>
                        <a href="<?php print $link ?>" class="<?php print $style_button ?>" <?php print $target ?>><?php print $button_title ?></a>   
                     <?php } ?>
                  </div>
               </div>
               
            </div>
         </div>
         <?php return ob_get_clean() ?>
      <?php
      }

   }
endif;   



