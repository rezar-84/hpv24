<?php 
if(!class_exists('element_gva_service_block')):
   class element_gva_service_block{
      public function render_form(){
         $fields = array(
            'type' => 'element_gva_service_block',
            'title' => t('Service Block'),
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'admin'     => true,
                  'default'   => 'Manage IT services',
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => "image",
                  'type'      => 'upload',
                  'title'     => t("Image"),
                  'class'     => 'width-1-2',
                  'default'   => '/sites/default/files/gbb-uploads/image-1.jpg'
               ),
               array(
                  'id'        => "icon",
                  'type'      => 'text',
                  'title'     => t("Icon"),
                  'default'   => 'flaticon-rating',
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => "link",
                  'type'      => 'text',
                  'title'     => t("Link"),
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'           => "content",
                  'type'         => 'text',
                  'title'        => t("Content"),
                  'default'      => ''
               ),
               array(
                  'id'        => 'style',
                  'type'      => 'select',
                  'title'     => t('Style'),
                  'options'   => array(
                     'style-1'   => 'Style 01',
                     'style-2'   => 'Style 02',
                     'style-3'   => 'Style 03',
                     'style-4'   => 'Style 04',
                     'style-5'   => 'Style 05'
                  ),
                  'class'     => 'width-1-4'
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra Class Name'),
                  'class'     => 'width-1-4'
               ),
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => t('Animation'),
                  'desc'      => t('Entrance animation for element'),
                  'options'   => gavias_content_builder_animate(),
                  'class'     => 'width-1-4'
               ), 
               array(
                  'id'        => 'animate_delay',
                  'type'      => 'select',
                  'title'     => t('Animation Delay'),
                  'options'   => gavias_content_builder_delay_wow(),
                  'desc'      => '0 = default',
                  'class'     => 'width-1-4'
               ),  
            ),                                     
         );
         return $fields;
      }

      public static function render_content( $attr = array(), $content = '' ){
         global $base_url;
         $default = array(
            'title'           => '',
            'style'           => 'style-1',
            'icon'            => '',
            'image'           => '',
            'content'         => '',
            'link'            => '',
            'el_class'        => '',
            'animate'         => '',
            'animate_delay'   => '',
            'col_lg'          => '4',
            'col_md'          => '3',
            'col_sm'          => '2',
            'col_xs'          => '1',
            'auto_play'       => '0',
            'pagination'      => '0',
            'navigation'      => '0'
         );

         extract(gavias_merge_atts($default, $attr));

         $classes = array();
         $classes[] = $el_class;
         $classes[] = $style;
         if($animate){
            $classes[] = 'wow'; 
            $classes[] = $animate; 
         }  
         if($image) $image = $base_url . $image; 
         $link = gavias_get_uri($link);
         ob_start();
      ?>
      <?php 
      if($style=='style-1'){
         print '<div class="service-one__single">';
            print '<div class="service-one__image">';
               if($image){
                  print '<img src="'. $image .'" alt="'. $title .'"/>';
               }
               if($icon){ 
                  print '<div class="service-one__icon"><i class="'. $icon .'"></i></div>';
               } 
            print '</div>';

            print '<div class="service-one__content">';
               print '<div class="service-one__content-inner">';
                  if($title){
                     print '<h3 class="service-one__title">' .  $title . '</h3>';
                  }
                          
                  if($content){ 
                     print '<div class="service-one__desc">' . $content . '</div>';
                  }   
                   
               print '</div>';
            print '</div>';  
            if($link){ 
               print '<a class="service-one__link" href="' . $link . '"></a>'; 
            } 
         print '</div>';
      }
      if($style=='style-2'){
         print '<div class="service-two__single"><div class="service-two__content">';
            if($image){
               print '<div class="service-two__image"><img src="'. $image .'" alt="'. $title .'"/></div>';
            }
            print '<div class="service-two__content-inner">';
               if($icon){ 
                  print '<div class="service-two__icon"><i class="'. $icon .'"></i></div>';
               }  
               if($title){
                  print '<h3 class="service-two__title">' .  $title . '</h3>';
               }       
               if($content){ 
                  print '<div class="service-two__desc">' . $content . '</div>';
               }   
            print '</div>';
            if($link){ 
               print '<a class="service-two__link-overlay" href="' . $link . '"></a>'; 
            }    
         print '</div></div>';
      }

      if($style=='style-3'){
         print '<div class="service-three__single"><div class="service-three__content">';
            if($image){
               print '<div class="service-three__image"><img src="'. $image .'" alt="'. $title .'"/></div>';
            }
            if($icon){ 
               print '<div class="service-three__icon"><span class="icon-inner"><i class="'. $icon .'"></i></span></div>';
            }
            print '<div class="service-three__content-inner">';
               if($title){
                  print '<h3 class="service-three__title">' .  $title . '</h3>';
               }
               if($content){ 
                  print '<div class="service-three__desc">' . $content . '</div>';
               }
               if($link){ 
                  print '<div class="service-three__content-action"><a class="btn-theme btn-small" href="' . $link . '"><span>' . t('Read more') . '</span></a></div>'; 
               }
            print '</div>';
            if($link){  
               print '<a class="service-three__overlay-link" href="' . $link . '"></a>'; 
            }    
         print '</div></div>';
      }

      if($style=='style-4'){
         print '<div class="service-four__single"><div class="service-four__content">';
            if($title){
               print '<h3 class="service-four__title">' .  $title . '</h3>';
            }
            if($icon){ 
               print '<div class="service-four__icon"><i class="'. $icon .'"></i></div>';
            }
            
            if($content){ 
               print '<div class="service-four__desc">' . $content . '</div>';
            }   
                
            print '</div>';
            if($link){ 
               print '<a class="service-four__link-overlay" href="' . $link . '"></a>'; 
            }
         print '</div>';
      }
      if($style=='style-5'){
         print '<div class="service-five__single">';
            if($image){
               print '<div class="service-five__image"><img src="'. $image .'" alt="'. $title .'"/></div>';
            }
            print '<div class="service-five__content"><div class="service-five__content-inner">';
               if($icon){ 
                  print '<div class="service-five__icon"><i class="'. $icon .'"></i></div>';
               }
               if($title){
                  print '<h3 class="service-five__title">' .  $title . '</h3>';
               }
               if($content){ 
                  print '<div class="service-five__desc">' . $content . '</div>';
               }  
               if($link){ 
                  print '<div class="service-five__action"><a class="btn-inline" href="' . $link . '"><span>' . t('Read more') . '</span></a></div>'; 
               } 
                
         print '</div></div>';
            if($link){ 
               print '<a class="service-five__link-overlay" href="' . $link . '"></a>'; 
            }
         print '</div>';
      }
 
      ?> 

      

      <?php return ob_get_clean();
      }
   }
endif;

