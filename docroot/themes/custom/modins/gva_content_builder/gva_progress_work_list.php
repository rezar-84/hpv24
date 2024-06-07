<?php 
if(!class_exists('element_gva_progress_work_list')):
   class element_gva_progress_work_list{
      public function render_form(){
         $fields = array(
            'type' => 'gva_progress_work',
            'title' => t('Progress Work'),
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title For Admin'),
                  'admin'     => true,
                  'default'   => 'Make a Decision',
               ),
               array(
                  'id'        => 'number',
                  'type'      => 'text',
                  'title'     => t('Number'),
                  'default'   => '01',
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'icon',
                  'type'      => 'text',
                  'title'     => t('Icon class'),
                  'default'   => 'flaticon-idea',
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'           => "content",
                  'type'         => 'text',
                  'title'        => t("Content"),
               ),
               array(
                  'id'        => 'skin',
                  'type'      => 'select',
                  'title'     => t('Skin'),
                  'options'   => array( 
                     'skin-v1' => t('Skin 1'), 
                     'skin-v2' => t('Skin 2'),
                     'skin-v3' => t('Skin 3')
                  ),
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'active',
                  'type'      => 'select',
                  'title'     => t('Active'),
                  'options'   => array( 'off' => 'No', 'on' => 'Yes' ),
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra Class Name'),
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

         return $fields;
      }

      public static function render_content( $attr = array(), $content = '' ){
         global $base_url;
         $default = array(
            'title'           => '',
            'number'          => '',
            'icon'            => '',
            'content'         => '',
            'active'          => 'off',
            'el_class'        => '',
            'link'            => '',
            'skin'            => 'skin-v1',
            'animate'         => '',
            'animate_delay'   => '',
         );

         extract(gavias_merge_atts($default, $attr));


         $classes = array();
         $classes[] = $skin;
         $classes[] = $el_class;
         if($active == 'on'){
            $classes[] = 'active'; 
         }
         if($animate){
            $classes[] = 'wow'; 
            $classes[] = $animate; 
         }  
         ob_start();
      ?>
         
      <?php if($skin == 'skin-v1'){ ?>
      <div class="workprocess-one__single <?php echo implode(' ', $classes) ?>">
         <div class="workprocess-one__top">
            <?php if($number){?>
              <div class="workprocess-one__number"><?php print $number ?></div>
            <?php } ?>
            <?php if($icon){?>
              <div class="workprocess-one__icon">
                  <span class="<?php print $icon ?>"></span>
               </div>
            <?php } ?>
         </div>
         <div class="workprocess-one__content">
            <?php
               if($title){
                  print '<h3 class="workprocess-one__title">' .  $title . '</h3>';
               }  
            ?>
            <?php
               if($content){
                  print '<div class="workprocess-one__desc">' .  $content . '</div>';
               }  
            ?>
         </div>
      </div>   
      <?php } ?>   
      <?php if($skin == 'skin-v2'){ ?>
         <div class="workprocess-two__single">
            <?php if($number){?>
              <div class="workprocess-two__number"><?php print $number ?></div>
            <?php } ?>
            <div class="workprocess-two__content">
               <?php 
                  if($icon){
                     print '<div class="workprocess-two__icon"><i class="' . $icon . '"></i></div>';
                  } 
                  if($title){
                     print '<h3 class="workprocess-two__title">' .  $title . '</h3>';
                  }  
                  if($content){
                     print '<div class="workprocess-two__desc">' .  $content . '</div>';
                  } 
                  if($link){ 
                     print '<div class="workprocess-two__action"><a class="btn-arrow" href="' . $link . '"><i class="fas fa-arrow-right"></i></a></div>';
                  } 
               ?>
            </div>
         </div>
      <?php } ?> 
      <?php if($skin == 'skin-v3'){ ?>
         <div class="workprocess-three__single <?php echo implode(' ', $classes) ?>">
            <?php if($number){?>
              <div class="workprocess-three__number"><?php print $number ?></div>
            <?php } ?>
            <div class="workprocess-three__content">
               <?php
                  if($title){
                     print '<h3 class="workprocess-three__title">' .  $title . '</h3>';
                  }  
               ?>
               <?php
                  if($content){
                     print '<div class="workprocess-three__desc">' .  $content . '</div>';
                  }  
               ?>
            </div>
         </div>  
      <?php } ?>   


      <?php return ob_get_clean();
   }

}
 endif;  



