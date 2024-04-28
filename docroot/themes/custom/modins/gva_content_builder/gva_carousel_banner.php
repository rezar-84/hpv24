<?php 
if(!class_exists('element_gva_carousel_banner')):
   class element_gva_carousel_banner{
      public function render_form(){
         $fields = array(
            'type' => 'element_gva_carousel_banner',
            'title' => t('Carousel - Banner'),
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title For Admin'),
                  'admin'     => true,
                  'default'   => 'Carousel - Banner'
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra Class Name'),
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
               'title'     => t("Title & Alt {$i}")
            );
            $fields['fields'][] = array(
               'id'        => "image_{$i}",
               'type'      => 'upload',
               'title'     => t("Image {$i}"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "link_{$i}",
               'type'      => 'text',
               'title'     => t("Link {$i}"),
               'class'     => 'width-1-2'
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
            $default["image_{$i}"]     = '';
            $default["title_{$i}"]     = '';
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
         
      <div class="el-carousel-banner <?php echo implode(' ', $classes) ?>"> 
         <div class="owl-carousel init-carousel-owl owl-loaded owl-drag" data-items="<?php print $col_lg ?>" data-items_lg="<?php print $col_lg ?>" data-items_md="<?php print $col_md ?>" data-items_sm="<?php print $col_sm ?>" data-items_xs="<?php print $col_xs ?>" data-loop="1" data-speed="500" data-auto_play="<?php print $auto_play ?>" data-auto_play_speed="2000" data-auto_play_timeout="5000" data-auto_play_hover="1" data-navigation="<?php print $navigation ?>" data-rewind_nav="0" data-pagination="<?php print $pagination ?>" data-mouse_drag="1" data-touch_drag="1">
            <?php for($i=1; $i<=10; $i++){ ?>
               <?php 
                  $title   = "title_{$i}";
                  $link    = "link_{$i}";
                  $image   = "image_{$i}";
                  $icon    = "icon_{$i}";
               ?>


               <?php if($$title && $style == 'style-1'){ ?>
                  <div class="item">
                     <div class="banner-one__single">
                        <?php if($$image){?>
                          <div class="banner-one__image"><img src="<?php print ($base_url . $$image) ?>" alt="<?php print $$title ?>"/></div>
                        <?php } ?>
                        <?php
                           if($$link){ 
                              print '<a class="banner-one__overlay-link" href="' . $$link . '"></a>';
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



