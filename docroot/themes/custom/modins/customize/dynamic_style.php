<style class="style-customize">:root {
<?php
    $style = '';
    $customize = (array)json_decode((string)$json, true);
    if($customize){

        if(isset($customize['theme_color']) && !empty($customize['theme_color'])){
          $style .= "--modins-theme-color:{$customize['theme_color']};";
        } 
        if(isset($customize['theme_color_second']) && !empty($customize['theme_color_second'])){
          $style .= "--modins-theme-color-second:{$customize['theme_color_second']};";
        } 
        if(isset($customize['font_family_primary']) && !empty($customize['font_family_primary']) && $customize['font_family_primary'] !='---'){
          $style .= "--modins-font-sans-serif:{$customize['font_family_primary']};";
        } 
        if(isset($customize['font_family_second']) && !empty($customize['font_family_second']) && $customize['font_family_second'] !='---'){
          $style .= "--modins-heading-font-family:{$customize['font_family_second']};";
        } 

        if(isset($customize['font_body_weight']) && !empty($customize['font_body_weight'])){
          $style .= "--font-body-weight:{$customize['font_body_weight']};";
        } 
        if(isset($customize['font_body_size']) && !empty($customize['font_body_size'])){
          $style .= "--font-body-size:{$customize['font_body_size']};";
        } 

        // Body
        if(isset($customize['body_color']) && !empty($customize['body_color'])){
          $style .= "--body-color:{$customize['body_color']};";
        }
        if(isset($customize['body_link_color']) && !empty($customize['body_link_color'])){
          $style .= "--body-link-color:{$customize['body_link_color']};";
        }
        if(isset($customize['body_link_color_hover']) && !empty($customize['body_link_color_hover'])){
          $style .= "--body-link-color-hover:{$customize['body_link_color_hover']};";
        }
        if(isset($customize['heading_color']) && !empty($customize['heading_color'])){
          $style .= "--heading-color:{$customize['heading_color']};";
        }

        // Topbar
        if(isset($customize['topbar_bg']) && !empty($customize['topbar_bg'])){
          $style .= "--topbar-bg-color:{$customize['topbar_bg']};";
        }
        if(isset($customize['topbar_color']) && !empty($customize['topbar_color'])){
          $style .= "--topbar-color:{$customize['topbar_color']};";
        }
        if(isset($customize['topbar_color_link']) && !empty($customize['topbar_color_link'])){
          $style .= "--topbar-link-color:{$customize['topbar_color_link']};";
        }
        if(isset($customize['topbar_color_link_hover']) && !empty($customize['topbar_color_link_hover'])){
          $style .= "--topbar-link-color-hover:{$customize['topbar_color_link_hover']};";
        }
        if(isset($customize['topbar_color_icon']) && !empty($customize['topbar_color_icon'])){
          $style .= "--topbar-color-icon:{$customize['topbar_color_icon']};";
        }

        // Menu
        if(isset($customize['menu_link_color']) && !empty($customize['menu_link_color'])){
          $style .= "--menu-link-color:{$customize['menu_link_color']};";
        }
        if(isset($customize['menu_link_color_hover']) && !empty($customize['menu_link_color_hover'])){
          $style .= "--menu-link-color-hover:{$customize['menu_link_color_hover']};";
        }
        if(isset($customize['submenu_bg_color']) && !empty($customize['submenu_bg_color'])){
          $style .= "--submenu-bg-color:{$customize['submenu_bg_color']};";
        }
        if(isset($customize['submenu_color']) && !empty($customize['submenu_color'])){
          $style .= "--submenu-color:{$customize['submenu_color']};";
        }
        if(isset($customize['submenu_link_color']) && !empty($customize['submenu_link_color'])){
          $style .= "--submenu-link-color:{$customize['submenu_link_color']};";
        }
        if(isset($customize['submenu_link_color_hover']) && !empty($customize['submenu_link_color_hover'])){
          $style .= "--submenu-link-color-hover:{$customize['submenu_link_color_hover']};";
        }

        // Footer
        if(isset($customize['footer_bg']) && !empty($customize['footer_bg'])){
          $style .= "--footer-bg-color:{$customize['footer_bg']};";
        }
        if(isset($customize['footer_color']) && !empty($customize['footer_color'])){
          $style .= "--footer-color:{$customize['footer_color']};";
        }
        if(isset($customize['footer_link_color']) && !empty($customize['footer_link_color'])){
          $style .= "--footer-link-color:{$customize['footer_link_color']};";
        }
        if(isset($customize['footer_link_color_hover']) && !empty($customize['footer_link_color_hover'])){
          $style .= "--footer-link-color-hover:{$customize['footer_link_color_hover']};";
        }

        print $style;
    } // end customize
?>   
}</style>
