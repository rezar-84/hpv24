<?php 
if(!class_exists('element_gva_carousel_features')):
   class element_gva_carousel_features{
      public function render_form(){
         $fields = array(
            'type' => 'element_gva_carousel_features',
            'title' => t('Carousel - Features'),
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title For Admin'),
                  'admin'     => true,
                  'default'   => 'Carousel - Features'
               ),
               array(
                  'id'        => 'style',
                  'type'      => 'select',
                  'title'     => t('Style'),
                  'options'   => array(
                     'style-1'   => 'Style 01',
                     'style-2'   => 'Style 02',
                     'style-3'   => 'Style 03'
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
               'id'        => "icon_{$i}",
               'type'      => 'text',
               'title'     => t("Icon {$i}"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "link_{$i}",
               'type'      => 'text',
               'title'     => t("Link {$i}"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'           => "content_{$i}",
               'type'         => 'text',
               'title'        => t("Content {$i}"),
            );
         }
         return $fields;
      }

      public static function render_content( $attr = array(), $content = '' ){
         global $base_url;
         $default = array(
            'title'           => '',
            'style'           => 'style-1',
            'bg_color'        => '',
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
            $default["icon_{$i}"]      = '';
            $default["image_{$i}"]     = '';
            $default["title_{$i}"]     = '';
            $default["content_{$i}"]   = '';
            $default["link_{$i}"]      = '';
         }

         extract(gavias_merge_atts($default, $attr));

         $classes = array();
         $classes[] = $el_class;
         $classes[] = $style;
         if($animate){
            $classes[] = 'wow'; 
            $classes[] = $animate; 
         }  
         ob_start();
      ?>
         
      <div class="el-carousel-feature <?php echo implode(' ', $classes) ?>"> 
         <div class="owl-carousel init-carousel-owl owl-loaded owl-drag" data-items="<?php print $col_lg ?>" data-items_lg="<?php print $col_lg ?>" data-items_md="<?php print $col_md ?>" data-items_sm="<?php print $col_sm ?>" data-items_xs="<?php print $col_xs ?>" data-loop="1" data-speed="500" data-auto_play="<?php print $auto_play ?>" data-auto_play_speed="2000" data-auto_play_timeout="5000" data-auto_play_hover="1" data-navigation="<?php print $navigation ?>" data-rewind_nav="0" data-pagination="<?php print $pagination ?>" data-mouse_drag="1" data-touch_drag="1">
            <?php for($i=1; $i<=10; $i++){ ?>
               <?php 
                  $title   = "title_{$i}";
                  $content = "content_{$i}";
                  $link    = "link_{$i}";
                  $image   = "image_{$i}";
                  $icon    = "icon_{$i}";

                  $$link = gavias_get_uri($$link);
               ?>

               <?php if($$title && $style == 'style-1'){ ?>
                  <div class="item">
                     <div class="feature-one__single">
                        <div class="feature-one__content">
                           <?php if($$image){?>
                             <div class="feature-one__image"><img src="<?php print ($base_url . $$image) ?>" alt="<?php print $$title ?>"/></div>
                           <?php } ?>
                           <?php 
                              if($$icon){
                                 print '<div class="feature-one__icon"><span class="icon-inner"><i class="' . $$icon . '"></i></span></div>';
                              }
                           ?>
                           <div class="feature-one__content-inner">
                              <?php 
                                 if($$title){
                                    print '<h3 class="feature-one__title">' .  $$title . '</h3>';
                                 } 
                                 if($$content){ print '<div class="feature-one__desc">' . $$content . '</div>'; } 
                                 if($$link){ 
                                    print '<div class="feature-one__content-action"><a class="btn-theme btn-small" href="' . $$link . '"><span>' . t('Read more') . '</span></a></div>';
                                 } 
                              ?>
                           </div>
                        </div>
                        <?php
                           if($$link){ 
                              print '<a class="feature-one__overlay-link" href="' . $$link . '"></a>';
                           } 
                        ?>
                     </div>
                  </div>
               <?php } ?> 

               <?php if($$title && $style == 'style-2'){ ?>
                  <div class="item">
                     <div class="feature-two__single">
                        <?php if($$image){?>
                          <div class="feature-two__image"><img src="<?php print ($base_url . $$image) ?>" alt="<?php print $$title ?>"/></div>
                        <?php } ?>
                        <div class="feature-two__content">
                           <div class="feature-two__content-inner">
                              <?php 
                                 if($$icon){
                                    print '<span class="feature-two__icon"><i class="' . $$icon . '"></i></span>';
                                 }
                                 if($$title){
                                    print '<h3 class="feature-two__title">' .  $$title . '</h3>';
                                 } 
                                 if($$content){ print '<div class="feature-two__desc">' . $$content . '</div>'; } 
                                 if($$link){ 
                                    print '<div class="feature-two__content-action"><a class="btn-inline" href="' . $$link . '"><span>' . t('Read more') . '</span></a></div>';
                                 } 
                              ?>
                           </div>
                        </div>
                        <?php
                           if($$link){ 
                              print '<a class="feature-two__overlay-link" href="' . $$link . '"></a>';
                           } 
                        ?>
                     </div>
                  </div>
               <?php } ?> 

               <?php if($$title && $style == 'style-3'){ ?>
                  <div class="item">
                     <div class="feature-three__single">
                        <?php 
                           if($$image){ 
                              print '<div class="feature-three__image"><img src="' . $base_url . $$image . '" alt="' . $$title . '"/>';
                              
                              if($$icon){
                                 print '<span class="feature-three__content-icon"><i class="' . $$icon . '"></i></span>';
                              }
                              print '</div>'; 
                           } 
                        ?>
                        <div class="feature-three__content">
                           <div class="feature-three__content-inner">
                              <?php 
                                 
                                 if($$title){
                                    print '<h3 class="feature-three__title">' .  $$title . '</h3>';
                                 } 
                                 if($$icon){
                                    print '<div class="feature-three__icon"><i class="' . $$icon . '"></i></div>';
                                 }
                                 if($$content){ 
                                    print '<div class="feature-three__desc">' . $$content . '</div>'; 
                                 }  
                              ?>
                           </div>
                        </div>
                        <?php
                           if($$link){ 
                              print '<a class="feature-three__overlay-link" href="' . $$link . '"></a>';
                           } 
                        ?>
                     </div>
                  </div>
               <?php } ?> 
               
               <?php if($$title && $style == 'style-4'){ ?>
                  <div class="item">
                     <div class="feature-four__single">
                        <div class="feature-four__content">
                           <?php 
                              if($$image){ 
                                 print '<div class="feature-four__image"><img src="' . $base_url . $$image . '" alt="' . $$title . '"/>';
                                 print '</div>'; 
                              } 
                           ?>
                        
                           <div class="feature-four__content-inner">
                              <?php 
                                 if($$icon){
                                    print '<span class="feature-four__icon"><i class="' . $$icon . '"></i></span>';
                                 }
                                 if($$title){
                                    print '<h3 class="feature-four__title">' .  $$title . '</h3>';
                                 } 
                                 if($$content){ 
                                    print '<div class="feature-four__desc">' . $$content . '</div>'; 
                                 } 
                              ?>
                           </div>
                        </div>
                        <?php
                           if($$link){ 
                              print '<a class="feature-four__overlay-link" href="' . $$link . '"></a>';
                           } 
                        ?>
                     </div>
                  </div>
               <?php } ?> 

            <?php } ?>
         </div>   
      </div> 

         <?php return ob_get_clean();
      }

   }
 endif;  



