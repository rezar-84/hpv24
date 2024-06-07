<?php
function gavias_pagebuilder_frontend( $params ) {
	global $base_url, $base_path;
	$classes = array(
		'1' => 'col-lg-1 col-md-1 col-sm-2 col-xs-12',
		'2' => 'col-lg-2 col-md-2 col-sm-4 col-xs-12',
		'3' => 'col-lg-3 col-md-3 col-sm-6 col-xs-12',
		'4' => 'col-lg-4 col-md-4 col-sm-12 col-xs-12',
		'5' => 'col-lg-5 col-md-5 col-sm-12 col-xs-12',
		'6' => 'col-lg-6 col-md-6 col-sm-12 col-xs-12',
		'7' => 'col-lg-7 col-md-7 col-sm-12 col-xs-12',
		'8' => 'col-lg-8 col-md-8 col-sm-12 col-xs-12',
		'9' => 'col-lg-9 col-md-9 col-sm-12 col-xs-12',
		'10' => 'col-lg-10 col-md-10 col-sm-12 col-xs-12',
		'11' => 'col-lg-11 col-md-11 col-sm-12 col-xs-12',
		'12' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12',
	);
	$content = json_decode($params, true);
	ob_start();
	if ( ! empty( $content ) ) {
		foreach ( $content as $k => $row ) {
			print (gavias_pagebuilder_render_el( $row ) );
		}
	}
	$content = ob_get_clean();		
	return $content;
}

 function gavias_pagebuilder_render_el( $data = array(), $content = '' ) {
		$settings = ! empty( $data['settings'] ) ? $data['settings'] : array();
		$content = '';
		//print'<pre>';print_r($data);
		if ( ! empty( $data['row'] ) ) {
			return gavias_pagebuilder_render_el( $data['row'] );
		}
		if ( ! empty( $data['columns'] ) || ! empty( $data['elements'] ) ) {
			ob_start();
			$has_els = array();
			if(!empty( $data['columns'] )){
				$has_els = $data['columns'];
			}else{
				if(!empty( $data['elements'])){
					$has_els = $data['elements'];
				}
			}

			foreach ( $has_els as $element ) {
				$subs = array();
				if(!empty( $data['columns'] )){
					$subs = $data['columns'];
				}else{
					if(!empty($data['elements'])){
						$subs = $data['elements'];
					}
				}
				if ( $subs ) {
					print gavias_pagebuilder_render_el( $element, $subs );
				}
			}
			$content = ob_get_clean();
		}

		if ( isset( $data['element_name'] ) && $data['element_name'] == 'gva_column' && ! empty( $data['col_lg'] ) ) {
			$settings['col_lg'] = $data['col_lg']; 
		}

		if ( isset( $data['element_name'] ) ) {
			if ( ! in_array( $data['element_name'], array( 'gva_row', 'gva_column' ) ) ) {
				ob_start();
				print gavias_pagebuilder_render_element($data['element_name'], $settings, $content);
				$content = ob_get_clean();
				return $content;
			}
			return gavias_pagebuilder_render_element($data['element_name'], $settings, $content);
		}
	}

	function gavias_pagebuilder_render_element($id = '', $settings = array(), $content =''){
		$_class = 'element_' . $id;
		if( class_exists($_class) ){
			$s = new $_class;
    		if(method_exists($s, 'render_content')){
    			foreach ( $settings as $key => $setting ) {
					if ( $key === $id ) {
						foreach ( $setting as $name => $value ) {
							$settings[$name] = $value;
						}
					}
				}
    			return $s->render_content( $settings, $content);
    		}
		}
	}