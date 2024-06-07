<?php 

if(!class_exists('element_gva_image_content')):
   class element_gva_image_content{
      public function render_form(){
         return array(
           'type'          => 'gsc_image_content',
            'title'        => t('Image content'),
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'admin'     => true,
               ),
               array(
                  'id'        => 'background',
                  'type'      => 'upload',
                  'title'     => t('Images'),
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'background_2',
                  'type'      => 'upload',
                  'title'     => t('Images 2'),
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content')
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
                  'class'     => 'width-1-3'
               ),

               array(
                  'id'        => 'text_link',
                  'type'      => 'text',
                  'title'     => t('Text Link'),
                  'class'     => 'width-1-3'
               ),

               array(
                  'id'        => 'target',
                  'type'      => 'select',
                  'title'     => t('Open in new window'),
                  'desc'      => t('Adds a target="_blank" attribute to the link'),
                  'options'   => array( 'off' => 'No', 'on' => 'Yes' ),
                  'std'       => 'on',
                  'class'     => 'width-1-3'
               ),

               array(
                  'id'        => 'skin',
                  'type'      => 'select',
                  'title'     => t('Skin'),
                  'options'   => array( 
                     'skin-v1' => t('Skin 1'), 
                     'skin-v2' => t('Skin 2'), 
                     'skin-v3' => t('Skin 3'),
                     'skin-v4' => t('Skin 4'),
                     'skin-v5' => t('Skin 5'), 
                     'skin-v6' => t('Skin 6'), 
                     'skin-v7' => t('Skin 7'),
                     'skin-v8' => t('Skin 8'), 
                  ),
                  'class'     => 'width-1-4'
               ),

               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
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
                  'options'   => gavias_content_builder_delay_aos(),
                  'desc'      => '0 = default',
                  'class'     => 'width-1-4'
               ), 
         
            ),                                     
         );
      }

      public static function render_content( $attr = array(), $content = '' ){
         global $base_url;
         extract(gavias_merge_atts(array(
            'title'              => '',
            'background'         => '',
            'background_2'       => '',
            'content'            => '',
            'link'               => '',
            'text_link'          => 'Read more',
            'target'             => '',
            'skin'               => 'skin-v1',
            'el_class'           => '',
            'animate'            => '',
            'animate_delay'      => ''
         ), $attr));

         // target
         if( $target =='on' ){
            $target = 'target="_blank"';
         } else {
            $target = false;
         }
         
         if($background) $background = $base_url . $background; 
         if($background_2) $background_2 = $base_url . $background_2; 

         if($skin) $el_class .= ' ' . $skin;
         if($animate) $el_class .= ' wow ' . $animate;
         $link = gavias_get_uri($link);
         $title_html = $link ? "<a {$target} href=\"{$link}\">{$title}</a>" : $title;
         
         ob_start();
         ?>

         <?php if($skin == 'skin-v1'){ ?>
            <div class="image-content-one__single <?php print $el_class; ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <div class="image-content-one__image">
                  <div class="image-inner">
                     <img src="<?php print $background ?>" alt="<?php print strip_tags($title) ?>" />
                     <?php
                        if($link){ 
                           print '<a class="image-content-one__link-overlay" ' . $target . ' href="' . $link . '"></a>';
                        } 
                     ?>
                  </div>
               </div>
               <div class="image-content-one__image-second">
                  <div class="image-inner">
                     <img src="<?php print $background_2 ?>" alt="<?php print strip_tags($title) ?>" />
                     <?php
                        if($link){ 
                           print '<a class="image-content-one__link-overlay" ' . $target . ' href="' . $link . '"></a>';
                        } 
                     ?>
                  </div>
               </div>
               <div class="image-content-one__content">
                  <div class="content-inner">
                     <?php 
                        if($title_html){
                           print '<h4 class="image-content-one__title">' . $title_html . '</h4>';
                        } 
                        if($content){
                           print '<div class="image-content-one__desc">' . $content . '</div>';
                        } 
                     ?>
                  </div>
               </div>  
            </div>
         <?php } ?> 
          

         <?php if($skin == 'skin-v2'){ ?>
            <div class="image-content-two__single <?php print $el_class; ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <div class="image-content-two__image">
                  <div class="image-inner">
                     <img src="<?php print $background ?>" alt="<?php print strip_tags($title) ?>" />
                     <?php
                        if($link){ 
                           print '<a class="image-content-two__link-overlay" ' . $target . ' href="' . $link . '"></a>';
                        } 
                     ?>
                  </div>
               </div>
               <?php if($background_2){ ?>
               <div class="image-content-two__image-second">
                  <div class="image-inner">
                     <img src="<?php print $background_2 ?>" alt="<?php print strip_tags($title) ?>" />
                     <?php
                        if($link){ 
                           print '<a class="image-content-two__link-overlay" ' . $target . ' href="' . $link . '"></a>';
                        } 
                     ?>
                  </div>
               </div> 
               <?php } ?>
            </div>
         <?php } ?> 

         <?php if($skin == 'skin-v3'){ ?>
            <div class="image-content-three__single <?php print $el_class; ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <div class="image-content-three__content">
                  <div class="image-content-three__image">
                     <div class="image-inner">
                        <img src="<?php print $background ?>" alt="<?php print strip_tags($title) ?>" />
                        <?php
                           if($link){ 
                              print '<a class="image-content-three__link-overlay" ' . $target . ' href="' . $link . '"></a>';
                           } 
                        ?>
                     </div>
                  </div>
                  <div class="image-content-three__content-inner">
                     <?php 
                        if($title_html){
                           print '<h4 class="image-content-three__title">' . $title_html . '</h4>';
                        } 
                        if($content){
                           print '<div class="image-content-three__desc">' . $content . '</div>';
                        }
                     ?>
                  </div>  
               </div>
            </div>
         <?php } ?> 

          <?php if($skin == 'skin-v4'){ ?>
            <div class="image-content-four__single <?php print $el_class; ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <div class="image-content-four__content">
                  <div class="image-content-four__image">
                     <img src="<?php print $background ?>" alt="<?php print strip_tags($title) ?>" />
                     <?php
                        if($link){ 
                           print '<a class="image-content-four__link-overlay" ' . $target . ' href="' . $link . '"></a>';
                        } 
                     ?>
                  </div>
                  <div class="image-content-four__content-inner">
                     <?php 
                        if($title_html){
                           print '<h4 class="image-content-four__title">' . $title_html . '</h4>';
                        } 
                        if($content){
                           print '<div class="image-content-four__desc">' . $content . '</div>';
                        }
                     ?>
                  </div>

               </div>  
            </div>
         <?php } ?> 
         <?php if($skin == 'skin-v5'){ ?>
            <div class="image-content-five__single <?php print $el_class; ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <div class="image-content-five__wrap">
                  <div class="image-content-five__left">
                     <div class="image-content-five__image">
                        <img src="<?php print $background ?>" alt="<?php print strip_tags($title) ?>" />
                        <?php
                           if($link){ 
                              print '<a class="image-content-five__link-overlay" ' . $target . ' href="' . $link . '"></a>';
                           } 
                        ?>
                     </div>
                     <div class="image-content-five__content">
                        <?php 
                           if($title_html){
                              print '<h4 class="image-content-five__title">' . $title_html . '</h4>';
                           } 
                           if($content){
                              print '<div class="image-content-five__desc">' . $content . '</div>';
                           }
                        ?>
                     </div>
                  </div>
                  <div class="image-content-five__image-second">
                     <img src="<?php print $background_2 ?>" alt="<?php print strip_tags($title) ?>" />
                     <?php
                        if($link){ 
                           print '<a class="image-content-five__link-overlay" ' . $target . ' href="' . $link . '"></a>';
                        } 
                     ?>
                  </div> 
               </div>
            </div>
         <?php } ?> 
         <?php if($skin == 'skin-v6'){ ?>
            <div class="image-content-six__single <?php print $el_class; ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <div class="image-content-six__image">
                  <img src="<?php print $background ?>" alt="<?php print strip_tags($title) ?>" />
                  <?php
                     if($link){ 
                        print '<a class="image-content-six__link-overlay" ' . $target . ' href="' . $link . '"></a>';
                     } 
                  ?>
               </div>
               <div class="image-content-six__content">
                  <div class="content-inner">
                  <?php 
                     if($title_html){
                        print '<h4 class="image-content-six__title">' . $title_html . '</h4>';
                     } 
                     if($content){
                        print '<div class="image-content-six__desc">' . $content . '</div>';
                     }
                     if($link){ 
                        print '<div class="image-content-six_action"><a class="btn-theme btn-small" href="' . $link . '"><span>' . $text_link . '</span></a></div>';
                     } 
                  ?>
                  </div>  
               </div>  
            </div>
         <?php } ?> 

         <?php if($skin == 'skin-v7'){ ?>
            <div class="image-content-seven__single <?php print $el_class; ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <div class="image-content-seven__image">
                  <div class="image-inner">
                     <img src="<?php print $background ?>" alt="<?php print strip_tags($title) ?>" />
                     <?php
                        if($link){ 
                           print '<a class="image-content-seven__link-overlay" ' . $target . ' href="' . $link . '"></a>';
                        } 
                     ?>
                  </div>
               </div> 
            </div>
         <?php } ?> 
         <?php if($skin == 'skin-v8'){ ?>
            <div class="image-content-eight__single <?php print $el_class; ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
               <div class="image-content-eight__image">
                  <img src="<?php print $background ?>" alt="<?php print strip_tags($title) ?>" />
               </div>
               <div class="image-content-eight__content">
                  <div class="content-inner">
                  <?php 
                     if($title_html){
                        print '<h4 class="image-content-eight__title">' . $title_html . '</h4>';
                     } 
                     if($content){
                        print '<div class="image-content-eight__desc">' . $content . '</div>';
                     }
                     if($link){ 
                        print '<div class="image-content-eight_action"><a class="btn-theme btn-small" href="' . $link . '"><span>' . $text_link . '</span></a></div>';
                     } 
                  ?>
                  </div>  
               </div> 
               <?php
                  if($link){ 
                     print '<a class="image-content-eight__link-overlay" ' . $target . ' href="' . $link . '"></a>';
                  } 
               ?> 
            </div>
         <?php } ?> 

         <?php return ob_get_clean() ?>
        <?php            
      } 

   }
endif;   
