<?php 
if(!class_exists('element_gva_drupal_block')):
   class element_gva_drupal_block{
      public function render_form(){
         $fields = array(
            'type' => 'gsc_drupal_block',
            'title' => ('Drupal Block'),
            'fields' => array(
               array(
                  'id'        => 'title_admin',
                  'type'      => 'text',
                  'title'     => t('Administrator Title'),
                  'admin'     => true,
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'block_drupal',
                  'type'      => 'select',
                  'title'     => t('Block for drupal'),
                  'options'   => gavias_content_builder_get_blocks_options(),
                  'class'     => 'width-1-2 change_value_admin'
               ),
               array(
                  'id'        => 'hidden_title',
                  'type'      => 'select',
                  'title'     => t('Hidden title'),
                  'options'   => array('on' => 'Display', 'off'=>'Hidden'),
                  'desc'      => t('Hidden title default for block'),
                  'class'     => 'width-1-2',
                  'default'   => 'off'
               ),
               array(
                  'id'        => 'align_title',
                  'type'      => 'select',
                  'title'     => t('Align title'),
                  'options'   => array('title-align-left' => 'Align Left', 'title-align-right'=>'Align Right', 'title-align-center' => 'Align Center'),
                  'std'       => 'title-align-center',
                  'desc'      => t('Align title default for block'),
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'remove_margin',
                  'type'      => 'select',
                  'title'     => ('Margin'),
                  'options'   => array('on' => 'Margin Bottom 0', 'off'=>'Margin Bottom 30px'),
                  'default'   => 'off',
                  'class'     => 'width-1-3'
               ),
               array(
                  'id'        => 'style_text',
                  'type'      => 'select',
                  'title'     => t('Skin Text for box'),
                  'options'   => array(
                     'text-dark'   => 'Text dark',
                     'text-light'   => 'Text light',
                  ),
                  'std'       => 'text-dark',
                  'class'     => 'width-1-3'
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
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

      public function render_content( $settings = array(), $content = '' ) {
         extract(gavias_merge_atts(array(
            'title'              => '',
            'block_drupal'       => '',
            'hidden_title'       => 'on',
            'align_title'        => 'title-align-center',
            'el_class'           => '',
            'style_text'         => '',
            'remove_margin'      => 'off',
            'animate'            => '',
            'animate_delay'      => ''
         ), $settings));
         
         $output = '';
         $class = array();
         $class[] = $align_title; 
         $class[] = $el_class;
         $class[] = 'hidden-title-' . $hidden_title;
         $class[] = 'remove-margin-' . $remove_margin;
         $class[] = $style_text;
         if($animate) $class[] = 'wow ' . $animate; 
         
         if($block_drupal){
            $output .= '<div class=" clearfix widget gsc-block-drupal '.implode(' ', $class) . '" ' . gavias_content_builder_print_animate_wow('', $animate_delay) . '>';
              $output .= gavias_content_builder_render_block($block_drupal);
            $output .= '</div>';
         } 
         return $output;  
      }
   }
endif;
   



