<?php 

if(!class_exists('element_gva_gallery')):
   class element_gva_gallery{

      public function render_form(){
         $fields = array(
            'type' => 'gsc_gallery',
            'title' => t('Gallery'),
            'size' => 3,
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title For Admin'),
                  'admin'     => true,
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'class'     => 'width-1-2'
               ),  
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => t('Animation'),
                  'desc'      => t('Entrance animation for element'),
                  'options'   => gavias_content_builder_animate(),
                  'class'     => 'width-1-2'
               ), 
               array(
                  'id'        => 'animate_delay',
                  'type'      => 'select',
                  'title'     => t('Animation Delay'),
                  'options'   => gavias_content_builder_delay_wow(),
                  'desc'      => '0 = default',
                  'class'     => 'width-1-2'
               ),  
            ),                                     
         );
         gavias_carousel_fields_settings($fields);

         for($i=1; $i<=10; $i++){
            $fields['fields'][] = array(
               'id'     => "info_{$i}",
               'type'   => 'info',
               'desc'   => "Information for item {$i}"
            );
            $fields['fields'][] = array(
               'id'        => "title_{$i}",
               'type'      => 'text',
               'title'     => t("Title {$i}"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "image_{$i}",
               'type'      => 'upload',
               'title'     => t("Image {$i}"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "content_{$i}",
               'type'      => 'text',
               'title'     => t("Content {$i}")
            );
         }
         return $fields;
      }

      public static function render_content( $attr = array(), $content = '' ){
         global $base_url;
         $default = array(
            'title'           => '',
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

         for($i=1; $i<=10; $i++){
            $default["title_{$i}"] = '';
            $default["image_{$i}"] = '';
            $default["content_{$i}"] = '';
         }

         extract(gavias_merge_atts($default, $attr));

         $_id = gavias_content_builder_makeid();
         
         if($animate) $el_class .= ' wow ' . $animate; 
         ob_start();
         ?>
         <div class="gsc-our-gallery <?php echo $el_class ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>> 
            <div class="owl-carousel init-carousel-owl owl-loaded owl-drag" data-items="<?php print $col_lg ?>" data-items_lg="<?php print $col_lg ?>" data-items_md="<?php print $col_md ?>" data-items_sm="<?php print $col_sm ?>" data-items_xs="<?php print $col_xs ?>" data-loop="1" data-speed="500" data-auto_play="<?php print $auto_play ?>" data-auto_play_speed="2000" data-auto_play_timeout="5000" data-auto_play_hover="1" data-navigation="<?php print $navigation ?>" data-rewind_nav="0" data-pagination="<?php print $pagination ?>" data-mouse_drag="1" data-touch_drag="1">
               <?php 
                  for($i=1; $i<=10; $i++){
                     $title = "title_{$i}";
                     $image = "image_{$i}";
                     $content = "content_{$i}";
                 
                     if($$title){ 
                        echo '<div class="item">';
                           echo '<div class="gallery-one__single">';
                              if($$image){
                                 echo '<div class="gallery-one__image">';
                                    echo '<img src="' . ($base_url . $$image) .'" alt="' . strip_tags($$title). '"/>';
                                 echo '</div>';
                              }
                              echo '<div class="gallery-one__content">';
                                 echo '<div class="gallery-one__content-inner">';
                                    if($$title){
                                       echo '<h4 class="gallery-one__title">' . $$title . '</h4>';
                                    }   
                                    if($$content){ 
                                       echo '<div class="gallery-one__desc">' . $$content . '</div>';
                                    }   
                                 echo '</div>';      
                              echo '</div>';      
                           echo '</div>';
                        echo '</div>';
                     } 

                  } 
               ?>
            </div> 
         </div>   
         <?php return ob_get_clean();
      }
   }
 endif;  



