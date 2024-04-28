<?php 
if(!class_exists('element_gva_text_noeditor')):
   class element_gva_text_noeditor{
      public function render_form(){
         $fields = array(
            'type' => 'gsc_text_noeditor',
            'title' => t('Text Without Editor'),
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Title'),
                  'admin'     => true,
                  'class'      => 'width-1-2'
               ),
               array(
                  'id'            => 'show_title',
                  'type'          => 'select',
                  'options'       => array(
                     'show'            => t('Show Title'), 
                     'hide'             => t('Hide Title')
                  ),
                  'title'      => t('Show Title'),
                  'default'    => 'hide',
                  'class'      => 'width-1-2'
               ),
               array(
                  'id'           => 'content',
                  'type'         => 'textarea_without_html',
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
            'show_title'      => 'hide',
            'content'         => '',
            'el_class'        => '',
            'animate'         => '',
            'animate_delay'   => ''
         ), $attr));

         if($animate) $el_class .= ' wow ' . $animate; 
         $output = '';
         $output .= '<div class="block block-custom-text ' . $el_class . '" ' . gavias_content_builder_print_animate_wow('', $animate_delay) .'>';
            if($title && $show_title == 'show'){
               $output .= '<h3 class="block-title"><span>' . $title . '</span></h3>';
            }
            $output .= '<div class="block-content">' . $content . '</div>';
         $output .= '</div>';
         return $output;
      }
   }
endif;  



