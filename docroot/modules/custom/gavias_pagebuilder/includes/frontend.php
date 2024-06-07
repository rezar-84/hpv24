<?php
function gavias_pagebuilder_frontend( $params ) {
	$output = '';
	$content = json_decode((string)$params, true);
	//ob_start();
	if ( ! empty( $content ) ) {
		foreach ( $content as $k => $row ) {
			$output .= gavias_pagebuilder_render_row( $row ) ;
		}
	}
	//$output = ob_get_clean();		
	return $output;
}

	function gavias_pagebuilder_render_row( $data = array(), $content = '' ) {
	$settings = ! empty( $data['settings'] ) ? $data['settings'] : array();
	$data['settings']['first_level'] = true;
	$content_columns = '';
	//print "<pre>"; print_r($data);
	// if ( ! empty( $data['row'] ) ) {
	// 	return gavias_pagebuilder_render_el( $data['row'] );
	// }

	if ( ! empty( $data['columns']) ){
		foreach ($data['columns'] as $key => $column) {
			$content_elements = '';
			$column['settings']['col_lg'] = $column['col_lg'];

			if(! empty( $column['elements'])){
				foreach ($column['elements'] as $key => $element) {
					
					$content_row_1 = ''; 
					if(!empty($element['row'])){
						$content_row_1 = gavias_pagebuilder_render_row_inner($element['row']);
					}

					if($element['element_name']=='gva_row'){
						$content_elements .= $content_row_1;
					}else{
						$content_elements .= gavias_pagebuilder_render_element($element['element_name'], $element['settings']);
					}
				}
			}
			$content_columns .= gavias_pagebuilder_render_element($column['element_name'], $column['settings'], $content_elements);
		}
	}

	$content = gavias_pagebuilder_render_element($data['element_name'], $data['settings'], $content_columns);

	return $content;

}

function gavias_pagebuilder_render_row_inner($row = array()){
		$content_row = '';
		$content_columns = '';
		if ( ! empty( $row['columns']) ){
			foreach ($row['columns'] as $key => $column) {
				$content_elements = '';
				$column['settings']['col_lg'] = $column['col_lg'];
				if(! empty( $column['elements'])){
					foreach ($column['elements'] as $key => $element) {
						if($element['element_name'] == 'gva_row'){
							$content_elements .= gavias_pagebuilder_render_row_inner($element['row']);
						}else{
							$content_elements .= gavias_pagebuilder_render_element($element['element_name'], $element['settings']);
						}
					}
				}
				$content_columns .= gavias_pagebuilder_render_element($column['element_name'], $column['settings'], $content_elements);
			}
		}
		$content_row = gavias_pagebuilder_render_element($row['element_name'], $row['settings'], $content_columns);
		return $content_row;
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


//Render css =============================================

function gavias_pagebuilder_frontend_css( $params ) {
	$style = '';
	$content = json_decode((string)$params, true);
	if ( ! empty( $content ) ) {
		foreach ( $content as $k => $row ) {
			$style .= gavias_pagebuilder_render_row_css( $row );
		}
	}
	return $style;
}


function gavias_pagebuilder_render_row_css( $data = array()) {
	$settings = ! empty( $data['settings'] ) ? $data['settings'] : array();
	$style = '';
	if ( !empty( $data['columns']) ){
		foreach ($data['columns'] as $key => $column) {
			if(! empty( $column['elements'])){
				foreach ($column['elements'] as $key => $element) {
					$style_row_inner = ''; 
					if( !empty($element['row']) ){
						$style_row_inner = gavias_pagebuilder_render_inner_row_css($element['row']);
					}
					if($element['element_name']=='gva_row'){
						$style .= $style_row_inner;
					}else{
						$style .= gavias_pagebuilder_render_el_css($element['element_name'], $element['settings']);
					}
				}
			}
			$style .= gavias_pagebuilder_render_el_css($column['element_name'], $column['settings']);
		}
	}
	$style .= gavias_pagebuilder_render_el_css($data['element_name'], $data['settings']);
	
	return $style;

}

function gavias_pagebuilder_render_inner_row_css($row = array()){
	$style = '';
	if ( !empty($row['columns']) ){
		foreach($row['columns'] as $key => $column){
			if(!empty($column['elements'])){
				foreach ($column['elements'] as $key => $element) {
					if($element['element_name'] == 'gva_row'){
						$style .= gavias_pagebuilder_render_inner_row_css($element['row']);
					}else{
						$style .= gavias_pagebuilder_render_el_css($element['element_name'], $element['settings']);
					}
				}
			}
			$style .= gavias_pagebuilder_render_el_css($column['element_name'], $column['settings']);
		}
	}

	$style .= gavias_pagebuilder_render_el_css($row['element_name'], $row['settings']);

	return $style;
}


function gavias_pagebuilder_render_el_css($id = '', $settings = array()){
	$_class = 'element_' . $id;
	if( class_exists($_class) ){
		$s = new $_class;
 		if(method_exists($s, 'render_style')){
 			foreach ( $settings as $key => $setting ) {
				if ( $key === $id ) {
					foreach ( $setting as $name => $value ) {
						$settings[$name] = $value;
					}
				}
			}
 			return $s->render_style($settings);
 		}
	}
}