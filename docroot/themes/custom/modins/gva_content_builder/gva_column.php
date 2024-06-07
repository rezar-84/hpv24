<?php
class element_gva_column{
	public function render_form(){
		return array(
			'title'	=> t('Column'),
			'key'    => 'gva_column',
			'fields'	=> array(
				array(
				  'id'        => 'info',
				  'type'      => 'info',
				  'title'      => 'Setting background for column'
				),
				array(
				  'id'       => 'bg_image',
				  'type'     => 'upload',
				  'title'    => ('Background Image'),
				  'class'       => 'width-1-2',
				),
				array(
				  'id'          => 'bg_color',
				  'type'        => 'text',
				  'title'       => ('Background Color'),
				  'desc'        => ('Use color name (eg. "gray") or hex (eg. "#808080").'),
				  'class'       => 'width-1-2',
				),
				array(
				  'id'         => 'bg_position',
				  'type'       => 'select',
				  'title'      => t('Background Position'),
				  'class'       => 'width-1-4',
				  'options'    => array(
					 	'center top' 			=> 'center top',
					 	'center right' 		=> 'center right',
					 	'center bottom' 		=> 'center bottom',
					 	'center center' 		=> 'center center',
					 	'left top' 			=> 'left top',
					 	'left center' 		=> 'left center',
					 	'left bottom' 		=> 'left bottom',
					 	'right top' 			=> 'right top',
					 	'right center' 		=> 'right center',
					 	'right bottom' 		=> 'right bottom',
				  	)
				),
				array(
				  	'id'         => 'bg_repeat',
				  	'type'       => 'select',
				  	'title'      => t('Background Position'),
				  	'class'       => 'width-1-4',
				  	'options'    => array(
					 	'no-repeat' 	=> 'no-repeat',
					 	'repeat' 		=> 'repeat',
					 	'repeat-x' 	=> 'repeat-x',
					 	'repeat-y' 	=> 'repeat-y',
					)
				),
				array(
				  	'id'         => 'bg_attachment',
				  	'type'       => 'select',
				  	'title'      => t('Background Attachment'),
				  	'class'       => 'width-1-4',
				  	'options'    => array(
					 	'scroll'    => 'Scroll',
					 	'fixed'     => ' Parallax',
				  		'bg-fixed'  => 'Fixed',
					),
				  	'default'         => 'scroll'
				),
				
				array(
				  'id'         => 'bg_size',
				  'type'       => 'select',
				  'title'      => t('Background Size'),
				  'class'       => 'width-1-4',
				  'options'    => array(
						'cover'      => 'cover',
						'contain'    => 'contain',
						'default'    => 'default'
					 ),
				  'default'         => 'cover'
				),
				array(
				  	'id'         => 'bg_layout',
				  	'type'       => 'select',
				  	'title'      => t('Background Layout'),
				  	'class'      => 'width-1-4',
				  	'options'    => array(
					 	'' 					=> '--Default--',
					 	'bg-inner' => 'Background Content Inner'
					)
				),
				array(
				  'id'        => 'info',
				  'type'      => 'info',
				  'title'      => 'Setting padding for column'
				),
				
				// Padding Row
				array(
				  'id'        => 'padding_top',
				  'type'      => 'number',
				  'title'     => t('Padding Top'),
				  'class'     => 'width-1-4',
				  'default'   => ''
				),
				array(
				  'id'          => 'padding_right',
				  'type'        => 'number',
				  'title'       => t('Padding Right'),
				  'class'       => 'width-1-4',
				  'default'     => ''
				),
				array(
				  'id'          => 'padding_bottom',
				  'type'        => 'number',
				  'title'       => t('Padding Bottom'),
				  'class'       => 'width-1-4',
				  'default'     => ''
				),
				array(
				  'id'          => 'padding_left',
				  'type'        => 'number',
				  'title'       => ('Padding Left'),
				  'class'       => 'width-1-4',
				  'default'     => ''
				),

				// == Padding LG
				array(
				  'id'        => 'padding_top_lg',
				  'type'      => 'number',
				  'title'     => t('Tablet | Padding Top'),
				  'class'     => 'width-1-4',
				  'default'   => ''
				),
				array(
				  'id'          => 'padding_right_lg',
				  'type'        => 'number',
				  'title'       => t('Tablet | Padding Right'),
				  'class'       => 'width-1-4',
				  'default'     => ''
				),
				array(
				  'id'          => 'padding_bottom_lg',
				  'type'        => 'number',
				  'title'       => t('Tablet | Padding Bottom'),
				  'class'       => 'width-1-4',
				  'default'     => ''
				),
				array(
				  'id'          => 'padding_left_lg',
				  'type'        => 'number',
				  'title'       => t('Tablet | Padding Left'),
				  'class'       => 'width-1-4',
				  'default'     => ''
				),

				// == Padding MD
				array(
				  'id'        => 'padding_top_md',
				  'type'      => 'number',
				  'title'     => t('Mobile | Padding Top'),
				  'desc'      => t('Padding Top for row (e.g. 30)'),
				  'class'     => 'width-1-4',
				  'desc'        => ('Example: 30'),
				  'default'   => ''
				),
				array(
				  'id'          => 'padding_right_md',
				  'type'        => 'number',
				  'title'       => t('Mobile | Padding Right'),
				  'class'       => 'width-1-4',
				  'desc'        => ('Example: 30'),
				  'default'     => ''
				),
				array(
				  'id'          => 'padding_bottom_md',
				  'type'        => 'number',
				  'title'       => t('Mobile | Padding Bottom'),
				  'class'       => 'width-1-4',
				  'desc'        => ('Example: 30'),
				  'default'     => ''
				),
				array(
				  'id'          => 'padding_left_md',
				  'type'        => 'number',
				  'title'       => ('Mobile | Padding Left'),
				  'desc'        => ('Example: 30'),
				  'class'     => 'width-1-4',
				  'default'         => '',
				),

				// Margin Row
				array(
				  'id'        => 'info',
				  'type'      => 'info',
				  'title'      => 'Setting margin for row'
				),
				// Padding Row
				array(
				  'id'        => 'margin_top',
				  'type'      => 'number',
				  'title'     => t('Margin Top'),
				  'class'     => 'width-1-4',
				  'default'   => ''
				),
				array(
				  'id'          => 'margin_right',
				  'type'        => 'number',
				  'title'       => t('Margin Right'),
				  'class'       => 'width-1-4',
				  'default'     => ''
				),
				array(
				  'id'          => 'margin_bottom',
				  'type'        => 'number',
				  'title'       => t('Margin Bottom'),
				  'class'       => 'width-1-4',
				  'default'     => ''
				),
				array(
				  'id'          => 'margin_left',
				  'type'        => 'number',
				  'title'       => ('Margin Left'),
				  'class'       => 'width-1-4',
				  'default'     => ''
				),
				
				// == Margin LG
				array(
				  'id'        => 'margin_top_lg',
				  'type'      => 'number',
				  'title'     => t('Tablet | Margin Top'),
				  'class'     => 'width-1-4',
				  'default'   => ''
				),
				array(
				  'id'          => 'margin_right_lg',
				  'type'        => 'number',
				  'title'       => t('Tablet | Margin Right'),
				  'class'       => 'width-1-4',
				  'default'     => ''
				),
				array(
				  'id'          => 'margin_bottom_lg',
				  'type'        => 'number',
				  'title'       => t('Tablet | Margin Bottom'),
				  'class'       => 'width-1-4',
				  'default'     => ''
				),
				array(
				  'id'          => 'margin_left_lg',
				  'type'        => 'number',
				  'title'       => t('Tablet | Margin Left'),
				  'class'       => 'width-1-4',
				  'default'     => ''
				),

				// == Margin MD
				array(
				  'id'        => 'margin_top_md',
				  'type'      => 'number',
				  'title'     => t('Mobile | Margin Top'),
				  'desc'      => t('Padding Top for row (e.g. 30)'),
				  'class'     => 'width-1-4',
				  'desc'        => ('Example: 30'),
				  'default'   => ''
				),
				array(
				  'id'          => 'margin_right_md',
				  'type'        => 'number',
				  'title'       => t('Mobile | Margin Right'),
				  'class'       => 'width-1-4',
				  'desc'        => ('Example: 30'),
				  'default'     => ''
				),
				array(
				  'id'          => 'margin_bottom_md',
				  'type'        => 'number',
				  'title'       => t('Mobile | Margin Bottom'),
				  'class'       => 'width-1-4',
				  'desc'        => ('Example: 30'),
				  'default'     => ''
				),
				array(
				  'id'          => 'margin_left_md',
				  'type'        => 'number',
				  'title'       => ('Mobile | Margin Left'),
				  'desc'        => ('Example: 30'),
				  'class'     => 'width-1-4',
				  'default'         => '',
				),

			  
				array(
				  'id'        => 'info',
				  'type'      => 'info',
				  'title'      => 'Setting style, class, id for columns'
				),
			 array(
				'id'         => 'vertical_align',
				'type'       => 'select',
				'title'      => t('Content Vertical Align'),
				'class'      => 'width-1-2',
				'options'    => array(
				  ''                 => 'Default',
				  'align-flex-start'        => 'Vertical Align Top',
				  'align-flex-center'       => 'Vertical Align Middle',
				  'align-flex-end'          => 'Vertical Align Bottom',
				)
			 ),
			 array(
				'id'         => 'style_class',
				'type'       => 'select',
				'title'      => t('Style Available'),
				'class'      => 'width-1-2',
				'options'    => array(
				  ''                 => 'Default',
				  'column-box-to-top'     => 'Style 1: Box & To Top',
				  'column-box-shadow'     => 'Style 2: Box Shadow',
				  'column-style-1'        => 'Style 3: Fixable width of column left when row-fullwidth',
				  'column-style-2'        => 'Style 4: Fixable width of column right when row-fullwidth',
				  'column-style-3'        => 'Style 5: Max Width 800px',
				)
			 ),
				array(
				  'id'      => 'el_class',
				  'type'    => 'text',
				  'title'   => ('Custom CSS Classes'),
				  'class'       => 'width-1-3'
				),
				array(
				  'id'      => 'class_inner',
				  'type'    => 'text',
				  'title'   => ('Custom Inner CSS Classes'),
				  'class'       => 'width-1-3'
				),
				
				array(
				  'id'      => 'id_column',
				  'type'    => 'text',
				  'title'   => ('Custom ID'),
				  'class'       => 'width-1-3'
				),
				
				array(
				  'id'        => 'info',
				  'type'      => 'info',
				  'title'      => 'Setting Responsive Visibility for Columns',
				  'class'       => 'width-1-3'
				),
				array(
				  'id' => 'hidden_lg',
				  'type'    => 'select',
				  'title'   => ('Hide on large screen'),
				  'class'   => 'width-1-4',
				  'options'   => array(
					 ''             => 'Show',   
					 'hidden-lg'    => 'Hidden'
				  )
				),
				array(
				  'id' => 'hidden_md',
				  'type'    => 'select',
				  'title'   => ('Hide on medium screen'),
				  'class'   => 'width-1-4',
				  'options'   => array(
						 ''             => 'Show',   
						 'hidden-sm'    => 'Hidden'
				  )
				),
				array(
				  'id' => 'hidden_sm',
				  'type'    => 'select',
				  'title'   => ('Hide on small screen'),
				  'class'   => 'width-1-4',
				  'options'   => array(
						 ''             => 'Show',   
						 'hidden-sm'    => 'Hidden'
				  )
				),
				array(
				  'id' => 'hidden_xs',
				  'type'    => 'select',
				  'title'   => ('Hide on extra small screen'),
				  'class'   => 'width-1-4',
				  'options'   => array(
						 ''            => 'Show',   
						 'hidden-xs'   => 'Hidden'
				  )
				),
				array(
				  'id'        => 'info',
				  'type'      => 'info',
				  'title'      => 'Setting Responsive Width for Columns'
				),
			  array(
				  'id' => 'col_lg_2',
				  'type'    => 'select',
				  'title'   => ('Large Screen < 1025px'),
				  'class'   => 'width-1-4',
				  'options'   => array(
						''         => 'Default',   
						'1'        => '1',
						'2'        => '2',
						'3'        => '3',
						'4'        => '4',
						'5'        => '5',
						'6'        => '6',
						'7'        => '7',
						'8'        => '8',
						'9'        => '9',
						'10'        => '10',
						'11'        => '11',
						'12'        => '12'
					)
				),
				array(
				  'id' => 'col_md',
				  'type'    => 'select',
				  'title'   => ('Medium Screen < 992px'),
				  'class'   => 'width-1-4',
				  'options'   => array(
						''         => 'Default',   
						'1'        => '1',
						'2'        => '2',
						'3'        => '3',
						'4'        => '4',
						'5'        => '5',
						'6'        => '6',
						'7'        => '7',
						'8'        => '8',
						'9'        => '9',
						'10'        => '10',
						'11'        => '11',
						'12'        => '12'
					)
				),
				array(
				  'id' => 'col_sm',
				  'type'    => 'select',
				  'title'   => ('Small Screen < 768px'),
				  'class'   => 'width-1-4',
				  'options'   => array(
						''         => 'Default',   
						'1'        => '1',
						'2'        => '2',
						'3'        => '3',
						'4'        => '4',
						'5'        => '5',
						'6'        => '6',
						'7'        => '7',
						'8'        => '8',
						'9'        => '9',
						'10'        => '10',
						'11'        => '11',
						'12'        => '12'
				  )
				),
				array(
				  'id' => 'col_xs',
				  'type'    => 'select',
				  'title'   => ('Extra Small < 576px'),
				  'class'   => 'width-1-4',
				  'options'   => array(
						''         => 'Default',   
						'1'        => '1',
						'2'        => '2',
						'3'        => '3',
						'4'        => '4',
						'5'        => '5',
						'6'        => '6',
						'7'        => '7',
						'8'        => '8',
						'9'        => '9',
						'10'        => '10',
						'11'        => '11',
						'12'        => '12'
					)
				),
			)
		);
	}

	public function render_content( $settings = array(), $content = '' ) {
		global $base_url, $base_path;
		extract(gavias_merge_atts(array(
			'bg_image'           	=> '',
			'bg_color'           	=> '',
			'bg_position'        	=> '',
			'bg_repeat'    			=> '',
			'bg_attachment'      	=> '',
			'bg_size'          		=> '',
			'bg_video'           	=> '',
			'bg_layout'					=> '',
			'hidden_lg'             => '',
			'hidden_md'             => '',
			'hidden_sm'             => '',
			'hidden_xs'             => '',
			'style_class'           => '',
			'vertical_align'        => '',
			'el_class'				   => '',
			'inner_class'				=> '',
			'id_column'					=> '',
			'col_lg'						=> '',
			'col_lg_2'              => '',
			'col_md'						=> '',
			'col_sm'						=> '',
			'col_xs'						=> '',
			'class_css'             => ''	
			), $settings));
		
			//Responsive
			switch ($col_lg) {
				case 1:
					$default_col_lg = 1; $default_col_md = 1; $default_col_sm = 2; $default_col_xs = 6;
					break;
				case 2: 
					$default_col_lg = 2;$default_col_md = 2; $default_col_sm = 4; $default_col_xs = 12;
					break;
				case 3: 
					$default_col_lg = 3;$default_col_md = 6; $default_col_sm = 12; $default_col_xs = 12;
					break;
				case 4: 
					$default_col_lg = 4;$default_col_md = 4; $default_col_sm = 12; $default_col_xs = 12;
					break;
				case 5: 
					$default_col_lg = 5;$default_col_md = 5; $default_col_sm = 12; $default_col_xs = 12;
					break;
				case 6: 
					$default_col_lg = 6;$default_col_md = 6; $default_col_sm = 12; $default_col_xs = 12;
					break;
				case 7: 
					$default_col_lg = 7;$default_col_md = 7; $default_col_sm = 12; $default_col_xs = 12;
					break;
				case 8: 
					$default_col_lg = 8;$default_col_md = 8; $default_col_sm = 12; $default_col_xs = 12;
					break;
				case 9: 
					$default_col_lg = 9;$default_col_md = 12; $default_col_sm = 12; $default_col_xs = 12;
					break;
				case 10: 
					$default_col_lg = 10;$default_col_md = 12; $default_col_sm = 12; $default_col_xs = 12;
					break;
				case 11: 
					$default_col_lg = 11;$default_col_md = 12; $default_col_sm = 12; $default_col_xs = 12;
					break;
				case 12: 
					$default_col_lg = 12;$default_col_md = 12; $default_col_sm = 12; $default_col_xs = 12;
					break;
				default:
					$default_col_lg = 12;$default_col_md = 12; $default_col_sm = 12; $default_col_xs = 12;
					break;
			}

			if(empty($col_lg)) $col_lg = $default_col_lg;
			if(empty($col_lg_2)) $col_lg_2 = $default_col_lg;
			if(empty($col_md)) $col_md = $default_col_md;
			if(empty($col_sm)) $col_sm = $default_col_sm;
			if(empty($col_xs)) $col_xs = $default_col_xs;

			$array_class = array();
			$array_style = array();
			$array_class_inner = array();

			$array_class[] = $class_css;

			$array_class[] = 'col-xxl-' . $col_lg;
			$array_class[] = 'col-xl-' . $col_lg;
			$array_class[]	= 'col-lg-' . $col_lg_2;
			$array_class[]	= 'col-md-' . $col_md;
			$array_class[]	= 'col-sm-' . $col_sm;
			$array_class[]	= 'col-xs-' . $col_xs;

			if($hidden_lg) $array_class[] = $hidden_lg;
			if($hidden_md) $array_class[] = $hidden_md;
			if($hidden_sm) $array_class[] = $hidden_sm;
			if($hidden_xs) $array_class[] = $hidden_xs;

			$array_class[]	= $el_class;
			$array_class[] = $vertical_align;

			if($bg_color) $array_style[] 	= 'background-color:'. $bg_color;

			$class_col_parallax = '';
			if( $bg_image){
				$array_style[] 	= 'background-image:url(\''. substr($base_path, 0, -1) . $bg_image .'\')';
				$array_style[] 	= 'background-repeat:' . $bg_repeat;
				if($bg_attachment == 'fixed'){
			 $array_style[]  = 'background-position: 50% 0';
			 $array_class[] = 'gva-parallax-background';
		  }else{
			 $array_class[] = $bg_attachment;
			 $array_class[] = 'bg-size-' . $bg_size;
			 $array_style[]  = 'background-position:' . $bg_position;
			 $array_style[]  = 'background-position:' . $bg_position;
		  }
			}
			
			$col_bg_size = 'bg-size-cover';
			if($bg_size){
				$col_bg_size = 'bg-size-' . $bg_size;
			}
			$array_class_inner[] = $class_col_parallax;
			$array_class_inner[] = $col_bg_size;
			$array_class_inner[] = $inner_class;
			$array_class[] = $style_class;

			$column_class = implode(' ', $array_class);
			$column_class_inner = implode(' ', $array_class_inner);
			$column_style = $column_style_inner = '';
			if($bg_layout == 'bg-inner'){
				$column_style_inner 	= implode('; ', $array_style);
				if(!empty($column_style_inner)){
					$column_style_inner = ' style="' . $column_style_inner . '"';
				}
			}else{
				$column_style 	= implode('; ', $array_style);
				if(!empty($column_style)){
					$column_style = ' style="' . $column_style . '"';
				}
			}
			
			ob_start();
		?>
		<div <?php if($id_column) print 'id="'.$id_column.'"' ?> class="gsc-column <?php print $column_class; ?>"<?php echo(($column_style) ? $column_style : '');  ?>>
			<div class="column-inner <?php print $column_class_inner ?>">
				<div class="column-content-inner">
				  <?php print $content; ?>
				</div>  
			</div>

		<?php if($column_style_inner){
				print '<div class="bg-column-inner"' . $column_style_inner . '></div>';
			}
		?>
			
		<?php if($bg_attachment == 'bg-fixed'){ 
		  $data_parallax = 'data-bottom-top="top: -60%;" data-top-bottom="top: 0%;"';
		  if($bg_position == 'center top'){
			 $data_parallax = 'data-bottom-top="top: -40%;" data-top-bottom="top: 20%;"';
		  }
		?>
		  <div style="background-repeat: <?php print $bg_repeat; ?>;background-position:<?php print $bg_position ?>;" class="<?php print $col_bg_size ?> gva-parallax-inner skrollable skrollable-between" <?php print $data_parallax ?>></div>
		 <?php } ?>  
		 </div>
		<?php return ob_get_clean();
	}

	public function render_style( $settings = array() ) {
		extract(gavias_merge_atts(array(
			'padding_top'           => '',
			'padding_right'         => '',
			'padding_bottom'        => '',
			'padding_left'          => '',
			'padding_top_lg'        => '',
			'padding_right_lg'      => '',
			'padding_bottom_lg'     => '',
			'padding_left_lg'       => '',
			'padding_top_md'        => '',
			'padding_right_md'      => '',
			'padding_bottom_md'     => '',
			'padding_left_md'       => '',

			'margin_top'            => '',
			'margin_right'          => '',
			'margin_bottom'         => '',
			'margin_left'           => '',
			'margin_top_lg'         => '',
			'margin_right_lg'       => '',
			'margin_bottom_lg'      => '',
			'margin_left_lg'        => '',
			'margin_top_md'         => '',
			'margin_right_md'       => '',
			'margin_bottom_md'      => '',
			'margin_left_md'        => '',
			'class_css'             => ''
		), $settings));
		
		$css = '';

		// Default
		$tmp_css = array();
		strlen($padding_top) ?        $tmp_css[] = 'padding-top:' . intval($padding_top) .'px' : false;
		strlen($padding_right) ?      $tmp_css[] = 'padding-right:' . intval($padding_right) .'px' : false;
		strlen($padding_bottom) ?     $tmp_css[] = 'padding-bottom:' . intval($padding_bottom) .'px': false;
		strlen($padding_left) ?       $tmp_css[] = 'padding-left:' . intval($padding_left) .'px': false;

		strlen($margin_top) ?         $tmp_css[] = 'margin-top:' . intval($margin_top) .'px': false;
		strlen($margin_right) ?       $tmp_css[] = 'margin-right:' . intval($margin_right) .'px': false;
		strlen($margin_bottom) ?      $tmp_css[] = 'margin-bottom:' . intval($margin_bottom) .'px': false;
		strlen($margin_left) ?        $tmp_css[] = 'margin-left:' . intval($margin_left) .'px': false;
		$css .= gavias_render_css("xl", ".{$class_css}", $tmp_css);

		 // Default LG
		$tmp_css = array();
		strlen($padding_top_lg) ?        $tmp_css[] = 'padding-top:' . intval($padding_top_lg) .'px': false;
		strlen($padding_right_lg) ?      $tmp_css[] = 'padding-right:' . intval($padding_right_lg) .'px': false;
		strlen($padding_bottom_lg) ?     $tmp_css[] = 'padding-bottom:' . intval($padding_bottom_lg) .'px': false;
		strlen($padding_left_lg) ?       $tmp_css[] = 'padding-left:' . intval($padding_left_lg) .'px': false;

		strlen($margin_top_lg) ?         $tmp_css[] = 'margin-top:' . intval($margin_top_lg) .'px': false;
		strlen($margin_right_lg) ?       $tmp_css[] = 'margin-right:' . intval($margin_right_lg) .'px': false;
		strlen($margin_bottom_lg) ?      $tmp_css[] = 'margin-bottom:' . intval($margin_bottom_lg) .'px': false;
		strlen($margin_left_lg) ?        $tmp_css[] = 'margin-left:' . intval($margin_left_lg) .'px': false;
		$css .= gavias_render_css("lg", ".{$class_css}", $tmp_css);

		 // Default MD
		$tmp_css = array();
		strlen($padding_top_md) ?        $tmp_css[] = 'padding-top:' . intval($padding_top_md) .'px': false;
		strlen($padding_right_md) ?      $tmp_css[] = 'padding-right:' . intval($padding_right_md) .'px': false;
		strlen($padding_bottom_md) ?     $tmp_css[] = 'padding-bottom:' . intval($padding_bottom_md) .'px': false;
		strlen($padding_left_md) ?       $tmp_css[] = 'padding-left:' . intval($padding_left_md) .'px': false;

		strlen($margin_top_md) ?         $tmp_css[] = 'margin-top:' . intval($margin_top_md) .'px': false;
		strlen($margin_right_md) ?       $tmp_css[] = 'margin-right:' . intval($margin_right_md) .'px': false;
		strlen($margin_bottom_md) ?      $tmp_css[] = 'margin-bottom:' . intval($margin_bottom_md) .'px': false;
		strlen($margin_left_md) ?        $tmp_css[] = 'margin-left:' . intval($margin_left_md) .'px': false;
		$css .= gavias_render_css("md", ".{$class_css}", $tmp_css);
		
		return $css;
	}

}