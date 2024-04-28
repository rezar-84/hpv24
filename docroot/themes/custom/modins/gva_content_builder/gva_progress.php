<?php 
if(!class_exists('element_gva_progress')):
   class element_gva_progress{
      public function render_form(){
         $fields = array(
            'type'   => 'gsc_progress',
            'title'  => t('Progress'),
            'fields' => array(
              array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'admin'     => true,
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'percent',
                  'type'      => 'text',
                  'title'     => t('Percent'),
                  'desc'      => t('Number between 0-100'),
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'style',
                  'type'      => 'select',
                  'title'     => 'Style',
                  'options'   => array(
                     'style-1'         => t('Theme Color'),
                     'style-2'         => t('Theme Color Second'), 
                     'style-3'         => t('Color White'), 
                     'style-4'         => t('Color Black')
                  ),
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
                  'options'   => gavias_content_builder_delay_wow(),
                  'desc'      => '0 = default',
                  'class'     => 'width-1-3'
               ), 
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
                  'class'     => 'width-1-3'
               ),
            ),                                     
         );
         return $fields;
      }

      public static function render_content( $attr = array(), $content = '' ){
         extract(gavias_merge_atts(array(
            'title'           => '',
            'percent'         => '',
            'background'      => '',
            'style'           => 'style-1',
            'animate'         => '',
            'animate_delay'   => '',
            'el_class'        => ''
         ), $attr));

         $class_array = array();
         $class_array[] = $el_class;
         $class_array[] = $style;
         if($animate) $class_array[] = 'wow ' . $animate; 
         $classes = count($class_array) ?  implode(' ', $class_array) : '';
         ob_start();
         ?>
         <div class="widget progress-one__single <?php print $classes; ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
            <div class="progress-one__label"><?php print $title ?></div>
            <div class="progress progress-one__content">
               <div class="progress-bar progress-one__bar" data-progress-animation="<?php print $percent ?>%"><span></span></div>
               <span class="percentage progress-one__percentage"><span></span><?php print $percent ?>%</span>
            </div>
         </div>   
         <?php return ob_get_clean() ?>
      <?php
      }
   }
 endif;  



