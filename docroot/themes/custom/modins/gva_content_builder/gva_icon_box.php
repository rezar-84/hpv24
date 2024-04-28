<?php 
if(!class_exists('element_gva_icon_box')):
   class element_gva_icon_box{
      public function render_form(){
         $fields = array(
            'type' => 'gsc_icon_box',
            'title' => ('Icon Box'), 
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'admin'     => true,
                  'default'   => 'Mobile Application'
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content'),
                  'desc'      => t('Some Shortcodes and HTML tags allowed'),
               ),
               array(
                  'id'        => 'icon',
                  'type'      => 'text',
                  'title'     => t('Icon class'),
                  'default'   => 'flaticon-idea',
                  'class'     => 'width-1-4'
               ),
               array(
                  'id'            => 'style',
                  'type'          => 'select',
                  'options'       => array(
                     'style-1'               => 'Style 01', 
                     'style-2'               => 'Style 02', 
                     'style-3'               => 'Style 03', 
                     'style-4'               => 'Style 04', 
                     'style-5'               => 'Style 05', 
                     'style-6'               => 'Style 06', 
                     'style-7'               => 'Style 07'
                  ),
                  'title'  => t('Style'),
                  'class'     => 'width-1-4'
               ),
               array(
                  'id'        => 'skin_text',
                  'type'      => 'select',
                  'title'     => 'Skin Text for box',
                  'options'   => array(
                     'text-dark'  => t('Text Dark'), 
                     'text-light' => t('Text Light')
                  ),
                  'class'     => 'width-1-4'
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
                  'desc'      => t('Link for text'),
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'target',
                  'type'      => 'select',
                  'options'   => array( 'off' => 'Off', 'on' => 'On' ),
                  'title'     => t('Open in new window'),
                  'desc'      => t('Adds a target="_blank" attribute to the link.'),
                  'class'     => 'width-1-2'
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
                  'options'   => gavias_content_builder_delay_aos(),
                  'desc'      => '0 = default',
                  'class'     => 'width-1-3'
               ), 
               
               array(
                  'id'     => 'el_class',
                  'type'      => 'text',
                  'title'  => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
                  'class'     => 'width-1-3'
               ),

            ),                                       
         );
         return $fields;
      }

      public static function render_content( $attr = array(), $content = '' ){
         global $base_url;
         extract(gavias_merge_atts(array(
            'title'              => '',
            'content'            => '',
            'icon'               => '',
            'style'              => 'style-1',
            'link'               => '',
            'skin_text'          => '',
            'target'             => 'on',
            'animate'            => '',
            'animate_delay'      => '',
            'min_height'         => '',
            'el_class'           => ''
         ), $attr));
         
         // target
         if( $target =='on' ){
            $target = 'target="_blank"';
         } else {
            $target = false;
         }

         $class = array();
         $class[] = $skin_text;
         if($el_class) $class[] = $el_class;
         
         $css = array(); 
         if($min_height) $css[] = "min-height:{$min_height};";
         
         if($animate) $class[] = 'wow ' . $animate;

         ob_start();
         ?>
         
         <?php if($style == 'style-1'){ ?>
            <div class="widget iconbox-one__single <?php if(count($class)>0) print implode(' ', $class) ?>" <?php if(count($css) > 0) print 'style="'.implode(';', $css).'"' ?> <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
                <?php 
                  if($icon){ 
                     print '<div class="iconbox-one__icon-inner">';
                     if($icon){ 
                        print '<span class="iconbox-one__icon ' . $icon . '"></span>';
                     } 
                     print '</div>';
                  } 
               ?>
               <div class="iconbox-one__content-inner">
                  <h3 class="iconbox-one__title"><?php print $title; ?></h3>
                  <?php 
                     if($content){ 
                        print '<div class="iconbox-one__desc">' . $content . '</div>';
                     } 
                  ?>   
               </div>
               <?php 
                  if($link){ 
                     print '<a class="iconbox-one__overlay-link" ' .$target . 'href="' . $link . '"></a>'; 
                  } 
               ?>
            </div> 
         <?php } ?>

         <?php if($style == 'style-2'){ ?>
            <div class="widget iconbox-two__single <?php if(count($class)>0) print implode(' ', $class) ?>" <?php if(count($css) > 0) print 'style="'.implode(';', $css).'"' ?> <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <?php 
                  if($icon){ 
                     print '<div class="iconbox-two__icon-inner">';
                     if($icon){ 
                        print '<span class="icon ' . $icon . '"></span>';
                     } 
                     print '</div>';
                  } 
               ?>
               <div class="iconbox-two__content-inner">
                  <h3 class="iconbox-two__title"><?php print $title; ?></h3>
                  <?php 
                     if($content){ 
                        print '<div class="iconbox-two__desc">' . $content . '</div>';
                     } 
                  ?>   
               </div>
               <?php 
                  if($link){ 
                     print '<a class="iconbox-two__overlay-link" ' .$target . 'href="' . $link . '"></a>'; 
                  } 
               ?>
            </div> 
         <?php } ?>


         <?php if($style == 'style-3'){ ?>
            <div class="widget iconbox-three__single <?php if(count($class)>0) print implode(' ', $class) ?>" <?php if(count($css) > 0) print 'style="'.implode(';', $css).'"' ?> <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <?php if($icon){ ?>
                  <div class="iconbox-three__icon-inner">
                        <span class="iconbox-three__icon <?php print $icon ?>"></span>
                  </div>
               <?php } ?>
               <div class="iconbox-three__content-inner">
                  <h3 class="iconbox-three__title"><span><?php print $title; ?></span></h3>
                  <?php if($content){
                     print '<div class="iconbox-three__desc">' . $content . '</div>'; 
                  } ?>   
               </div>

               <?php if($link){ 
                  print '<a class="iconbox-three__link-overlay" ' . $target . ' href="' . $link . '"></a>'; 
               } ?>
            </div> 
         <?php } ?>

         <?php if($style == 'style-4'){ ?>
            <div class="widget iconbox-four__single <?php if(count($class)>0) print implode(' ', $class) ?>" <?php if(count($css) > 0) print 'style="'.implode(';', $css).'"' ?> <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <div class="iconbox-four__content">
                  <?php 
                     if($icon){ 
                        print '<div class="iconbox-four__icon">';
                           if($icon){ 
                              print '<span class="icon ' . $icon . '"></span>';
                           }
                        print '</div>';
                     } 
                  ?>

                  <div class="iconbox-four__content-inner">
                     <h3 class="iconbox-four__title"><span><?php print $title; ?></span></h3>
                     <?php 
                        if($content){ 
                           print '<div class="iconbox-four__desc">' . $content . '</div>';
                        } 
                     ?>   
                  </div>

                  <?php 
                     if($link){ 
                        echo '<a class="iconbox-four__link" ' . $target . 'href="' . $link . '"></a>';  
                     } 
                  ?>
               </div> 
            </div>   
         <?php } ?>  

         <?php if($style == 'style-5'){ ?>
            <div class="widget iconbox-five__single <?php if(count($class)>0) print implode(' ', $class) ?>" <?php if(count($css) > 0) print 'style="'.implode(';', $css).'"' ?> <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <?php 
                  if($icon){ 
                     print '<div class="iconbox-five__icon-inner">';
                        if($icon){ 
                           print '<span class="icon ' . $icon . '"></span>';
                        }
                     print '</div>';
                  } 
               ?>
               <div class="iconbox-five__content-inner">
                  <h3 class="iconbox-five__title"><?php print $title; ?></h3>
                  <div class="iconbox-five__desc"><?php print $content; ?></div>
               </div>
               <?php 
                  if($link){ 
                     echo '<a class="iconbox-five__link" ' . $target . 'href="' . $link . '"></a>';  
                  } 
               ?>
            </div> 
         <?php } ?>

         <?php if( $style == 'style-6'){ ?>
            <div class="widget iconbox-six__single <?php if(count($class)>0) print implode(' ', $class) ?>" <?php if(count($css) > 0) print 'style="'.implode(';', $css).'"' ?> <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <?php 
                  if($icon){ 
                     print '<div class="iconbox-six__icon-inner">';
                        if($icon){ 
                           print '<span class="icon ' . $icon . '"></span>';
                        }
                     print '</div>';
                  } 
               ?>
               <div class="iconbox-six__content-inner">
                  <h3 class="iconbox-six__title"><?php print $title; ?></h3>
                  <div class="iconbox-six__desc"><?php print $content; ?></div>
               </div>
               <?php 
                  if($link){ 
                     echo '<a class="iconbox-six__link" ' . $target . 'href="' . $link . '"></a>';  
                  } 
               ?>
            </div>  
         <?php } ?>

         <?php if( $style == 'style-7'){ ?>
            <div class="widget iconbox-seven__single <?php if(count($class)>0) print implode(' ', $class) ?>" <?php if(count($css) > 0) print 'style="'.implode(';', $css).'"' ?> <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <div class="iconbox-seven__wrap">
                  <?php 
                     if($icon){ 
                        print '<div class="iconbox-seven__icon-inner">';
                           if($icon){ 
                              print '<span class="icon ' . $icon . '"></span>';
                           }
                        print '</div>';
                     } 
                  ?>
                  <div class="iconbox-seven__content-inner">
                     <h3 class="iconbox-seven__title"><?php print $title; ?></h3>
                     <div class="iconbox-seven__desc"><?php print $content; ?></div>
                  </div>
                  <?php 
                     if($link){ 
                        echo '<a class="iconbox-seven__link" ' . $target . 'href="' . $link . '"></a>';  
                     } 
                  ?>
               </div>   
            </div>  
         <?php } ?>

         <?php return ob_get_clean() ?>
       <?php
      }

   } 
endif;   
