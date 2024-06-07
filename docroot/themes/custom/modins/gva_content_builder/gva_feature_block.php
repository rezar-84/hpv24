<?php 
if(!class_exists('element_gva_feature_block')):
   class element_gva_feature_block{
      public function render_form(){
         $fields = array(
            'type' => 'element_gva_feature_block',
            'title' => t('Features Block'),
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
                  'type'         => 'textarea',
                  'title'        => t("Content"),
                  'default'      => 'There are many lipsum of in pass sages of available some.'
               ),
               array(
                  'id'        => 'style',
                  'type'      => 'select',
                  'title'     => t('Style'),
                  'options'   => array(
                     'style-1'   => 'Style 01',
                     'style-2'   => 'Style 02',
                     'style-3'   => 'Style 03',
                     'style-4'   => 'Style 04'
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
         );

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
      <?php $link = gavias_get_uri($link); ?>
      <div class="el-feature-block <?php echo implode(' ', $classes) ?>"> 

         <?php if($title && $style == 'style-1'){ ?>
            <div class="feature-one__single">
               <?php if($image){?>
                 <div class="feature-one__img"><img src="<?php print ($base_url . $image) ?>" alt="<?php print $title ?>"/></div>
               <?php } ?>

               <?php
                  if($title){
                     print '<h3 class="feature-one__title">' .  $title . '</h3>';
                  }  
               ?>
               <div class="feature-one__content">
                  <div class="feature-one__content-inner">
                     <?php 
                        if($icon){
                           print '<span class="feature-one__content-icon"><i class="' . $icon . '"></i></span>';
                        }
                        if($title){
                           print '<h3 class="feature-one__content-title">' .  $title . '</h3>';
                        } 
                        if($content){ print '<div class="feature-one__content-desc">' . $content . '</div>'; } 
                        if($link){ 
                           print '<div class="feature-one__content-action"><a class="btn-theme" href="' . $link . '"><span>' . t('Get a Quote') . '</span></a></div>';
                        } 
                     ?>
                  </div>
               </div>
               <?php
                  if($link){ 
                     print '<a class="overlay-link" href="' . $link . '"></a>';
                  } 
               ?>
            </div>
         <?php } ?>   

         <?php if($style == 'style-2'){ ?>
            <div class="feature-two__single">
               <?php if($image){?>
                 <div class="feature-two__image"><img src="<?php print ($base_url . $image) ?>" alt="<?php print $title ?>"/></div>
               <?php } ?>
               <div class="feature-two__content">
                  <div class="feature-two__content-inner">
                     <?php 
                        if($icon){
                           print '<span class="feature-two__icon"><i class="' . $icon . '"></i></span>';
                        }
                        if($title){
                           print '<h3 class="feature-two__title">' .  $title . '</h3>';
                        } 
                        if($content){ print '<div class="feature-two__desc">' . $content . '</div>'; } 
                        if($link){ 
                           print '<div class="feature-two__content-action"><a class="btn-inline" href="' . $link . '"><span>' . t('Read more') . '</span></a></div>';
                        } 
                     ?>
                  </div>
               </div>
               <?php
                  if($link){ 
                     print '<a class="overlay-link" href="' . $link . '"></a>';
                  } 
               ?>
            </div>
         <?php } ?> 

         <?php if($style == 'style-3'){ ?>
            <div class="feature-three__single">
               <?php 
                  if($image){ 
                     print '<div class="feature-three__image"><img src="' . $base_url . $image . '" alt="' . $title . '"/>';
                     if($icon){
                           print '<span class="feature-three__content-icon"><i class="' . $icon . '"></i></span>';
                        }
                     print '</div>';
                     
                  } 
               ?>
               <div class="feature-three__content">
                  <div class="feature-three__content-inner">
                     <?php 
                        
                        if($title){
                           print '<h3 class="feature-three__content-title">' .  $title . '</h3>';
                        } 
                        if($content){ 
                           print '<div class="feature-three__content-desc">' . $content . '</div>'; 
                        }  
                     ?>
                  </div>
               </div>
                <?php if($link){ 
                  print '<a class="overlay-link" href="' . $link . '"></a>';
               } ?>
            </div>
         <?php } ?>

         <?php if($style == 'style-4'){ ?>
            <div class="feature-four__single">
               <?php 
                  if($image){ 
                     echo '<div class="feature-four__image"><img src="' . $base_url . $image . '" alt="' . $title . '"/></div>';
                  } 
               ?>
               <div class="feature-four__content">
                  <div class="feature-four__content-inner">
                     <?php 
                        if($icon){
                           print '<span class="feature-four__icon"><i class="' . $icon . '"></i></span>';
                        }
                        if($title){
                           print '<h3 class="feature-four__title">' .  $title . '</h3>';
                        } 
                        if($content){ 
                           print '<div class="feature-four__desc">' . $content . '</div>'; 
                        } 
                     ?>
                  </div>
               </div>
               <?php if($link){ 
                  print '<a class="overlay-link" href="' . $link . '"></a>';
               } ?>
            </div>
         <?php } ?> 


      </div> 

      <?php return ob_get_clean();
      }
   }
endif;

