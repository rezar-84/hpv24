<?php
if(!function_exists('gavias_content_builder_animate')){
    function gavias_content_builder_animate(){
        return array(
            ''          => '- Not Animated -',
            'fadeIn'      => 'Fade In',
            'fadeInUp'      => 'Fade In Up',
            'fadeInDown'    => 'Fade In Down ',
            'fadeInLeft'    => 'Fade In Left',
            'fadeInRight'     => 'Fade In Right ',
            'fadeInUpBig'   => 'Fade In Up Big',
            'fadeInDownBig'   => 'Fade In Down Big',
            'fadeInLeftBig'   => 'Fade In Left Big',
            'fadeInRightBig'  => 'Fade In Right Big',
            'zoomIn'      => 'Zoom In',
            'zoomInUp'      => 'Zoom In Up',
            'zoomInDown'    => 'Zoom In Down',
            'zoomInLeft'    => 'Zoom In Left',
            'zoomInRight'     => 'Zoom In Right',
            'bounceIn'      => 'Bounce In',
            'bounceInUp'    => 'Bounce In Up',
            'bounceInDown'    => 'Bounce In Down',
            'bounceInLeft'    => 'Bounce In Left',
            'bounceInRight'   => 'Bounce In Right',
        );
    }
}

if(!function_exists('gavias_content_builder_animate_aos')){
    function gavias_content_builder_animate_aos(){
        return array(
            ''                  => '- Not Animated -',
            'fade'              => 'Fade',
            'fade-up'           => 'Fade Up',
            'fade-down'         => 'Fade Down',
            'fade-left'         => 'Fade Left',
            'fade-right'        => 'Fade Right',
            'flip-up'           => 'Flip X',
            'flip-down'         => 'Flip Y',
            'slide-up'          => 'Slide Up',
            'slide-down'        => 'Slide Down',
            'slide-left'        => 'Slide Left',
            'slide-right'       => 'Slide Right',
            'zoom-in'           => 'zoom In',
            'zoom-in-up'        => 'zoom In Up',
            'zoom-in-down'      => 'zoom In Down',
            'zoom-in-left'      => 'zoom In Left',
            'zoom-in-right'     => 'zoom In Right',
            'zoom-out'          => 'zoom Out',
            'zoom-out-up'       => 'zoom Out Up',
            'zoom-out-down'     => 'zoom Out Down',
            'zoom-out-left'     => 'zoom Out Left',
            'zoom-out-right'    => 'zoom Out Right'
        );
    }
 }

if(!function_exists('gavias_content_builder_delay_aos')){
    function gavias_content_builder_delay_aos(){
        $results = array();
        foreach (range(0, 10000, 100) as $number) {
            $results[$number] = ($number * 0.001) . 's';
        }
        return $results;
    }
}

if(!function_exists('gavias_content_builder_print_animate_aos')){
    function gavias_content_builder_print_animate_aos( $animate='', $delay ='' ){
        $ouput = '';
        if($animate){
            $ouput .= 'data-aos="'.$animate.'"';
        }
        if($delay && !empty($delay) && $delay != 0){
            $ouput .= ' data-aos-delay="'.$delay.'"';
        }
        return $ouput;
    }
}

//WOW
if(!function_exists('gavias_content_builder_delay_wow')){
    function gavias_content_builder_delay_wow(){
        $results = array();
        foreach (range(0, 10, 0.2) as $number) {
            $results[$number.'s'] = $number . 's';
        }
        return $results;
    }
}

if(!function_exists('gavias_content_builder_print_animate_wow')){
    function gavias_content_builder_print_animate_wow( $duration='', $delay ='' ){
        $ouput = '';
      
        if($duration){
            $ouput .= 'data-wow-duration="'.$duration.'"';
        }
        if($delay && !empty($delay) && $delay != '0s'){
            if(is_numeric($delay) && $delay > 100) $delay = (0.001 * $delay) . 's';
            $ouput .= ' data-wow-delay="'.$delay.'"';
        }
        return $ouput;
    }
}

if(!function_exists('gavias_content_builder_print_animate_wow_delay')){
    function gavias_content_builder_print_animate_wow_delay($animate, $delay ='' ){
        $ouput = '';
        if(empty($animate)) return '';
        if($animate && $delay == '0s') $delay == '0.05s';
        if($delay && !empty($delay) && $delay != '0s'){
            if(is_numeric($delay) && $delay > 100) $delay = (0.001 * $delay) . 's';
            $ouput .= ' data-wow-delay="'.$delay.'"';
        }
        return $ouput;
    }
}