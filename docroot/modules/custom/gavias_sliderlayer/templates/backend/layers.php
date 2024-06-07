<?php 
  global $base_url;
  $width = '1170px'; $height = '600px';
  if( isset($group_settings_decode->gridwidth) && $group_settings_decode->gridwidth ){
    $width = $group_settings_decode->gridwidth . 'px';
  }
  if(isset($group_settings_decode->gridheight) && $group_settings_decode->gridheight){
    $height = ($group_settings_decode->gridheight) . 'px';
  }
  
  $_id = gavias_sliderlayer_makeid(10);
?>

<div class="preview-option" style="margin: 0 0 10px;text-align: center;"> 
    <select id="prview-option-screen" style="max-width: 200px;">
      <option value="">Default Screen</option>
      <option value="_sm">Medium Screen</option>
      <option value="_xs">Small Screen</option>
    </select>
</div>

<div id="gavias_slider_single" style="background-size: cover; margin:0 auto;width:<?php print $width ?>; height: <?php print $height ?>; border: 1px solid #ccc; list-style: none;position: relative;">
  
</div>

<div class="vertical-tabs layer-single-settingsss layer-settings__lg clearfix">
  <div class="vertical-tabs-list">
  <ul id="gavias_list_layers">    
  </ul>
  <div class="clearfix"></div>
  <a href="#" id="add_layer">Add Layer</a>
  </div>
  <div class="vertical-tabs-panes vertical-tabs-processed" id="layeroptions" style="display: none">
    
    <fieldset class="fieldset-wrapper g-wrapper">
    <div class="gavias-heading">Layer Style Setting</div>
    <table style="padding: 10px 20px 20px;">
      <tr>
        <td width="40%">
          <div class="g-label">Layer style</div> 
         <select class="select-content-type layer-option" name="select_content_type">
            <option value="text">Text</option>
            <option value="image">Image</option>
          </select>
        </td>
        <td width="50%">
          <div class="g-label">Title</div> 
          <div>
            <input type="text" name="title" class="form-text layer-option"/>
            <input type="hidden" class="layer-option" name="content" value=""/>
          </div>  
        </td>
      </tr>

      <tr>
        <td colspan="3">
          <div id="content-type" style="margin-top: 20px;">
            <div id="content-text" class="g-content-setting" style="border: none; padding-top: 20px;border-top: 1px solid #ccc;">
              <div style="width: 50%; float:left;">
                <div style="float: left; width: 36%; display: none;">
                  <div class="g-label">Text style</div> 
                  <?php print gavias_defined_select('text_style', gavias_sliderlayer_captionclasses(),'layer-option'); ?>
                </div>

                <div style="float: left; width: 24%;margin-right: 1%;">
                  <div class="g-label" style="margin-top: 10px;">Font Size (px)</div>
                  <div class="g-input">
                    <input type="number" name="font_size_lg" placeholder="Large Screen" class="form-text layer-option option-responsive option-lg"/>
                    <input type="number" name="font_size_sm" placeholder="Medium Screen" class="form-text layer-option option-responsive option-sm"/>
                    <input type="number" name="font_size_xs" placeholder="Small Screen" class="form-text layer-option option-responsive option-xs"/>
                  </div>
                </div>  

                <div style="float: left; width: 24%;margin-right: 1%;">
                  <div class="g-label" style="margin-top: 10px;">Line Height (px)</div>
                  <div class="g-input">
                    <input type="number" name="line_height_lg" placeholder="Large Screen" class="form-text layer-option option-responsive option-lg"/>
                    <input type="number" name="line_height_sm" placeholder="Medium Screen" class="form-text layer-option option-responsive option-sm" />
                    <input type="number" name="line_height_xs" placeholder="Small Screen" class="form-text layer-option option-responsive option-xs" />
                  </div>
                </div> 

                <div style="float: left; width: 24%;margin-right: 1%;">
                  <div class="g-label" style="margin-top: 10px;">Align</div>
                  <div class="g-input">
                    <select name="text_align_lg" class="form-text layer-option option-responsive option-lg">
                      <option value="left">Left</option>
                      <option value="right">Right</option>
                      <option value="center">Center</option>
                    </select>
                    <select name="text_align_sm" class="form-text layer-option option-responsive option-sm">
                      <option value="left">Left</option>
                      <option value="right">Right</option>
                      <option value="center">Center</option>
                    </select>
                    <select name="text_align_xs" class="form-text layer-option option-responsive option-xs">
                      <option value="left">Left</option>
                      <option value="right">Right</option>
                      <option value="center">Center</option>
                    </select>
                  </div>
                </div> 

                <div style="float: left; width: 24%;">
                  <div class="g-label" style="margin-top: 10px;">Color</div>
                  <div class="g-input">
                    <input type="text" name="color_lg" placeholder="#fff" class="color-picker form-text layer-option option-responsive option-lg" readonly="true" />
                    <input type="text" name="color_sm" placeholder="#fff" class="color-picker form-text layer-option option-responsive option-sm" readonly="true"/>
                    <input type="text" name="color_xs" placeholder="#fff" readonly="true" class="color-picker form-text layer-option option-responsive option-xs" readonly="true"/>
                  </div>
                </div>  

              </div>  

              <div style="width: 50%;float: left;">
                <textarea class="layer-option form-textarea" rows="5" name="text" id="layer-text" style="height: 100px; font-size: 14px;"></textarea>
              </div>

            </div>

            <div id="content-image" class="g-content-setting filed-upload-layer-content" style="display: none;">
              <?php print gavias_sliderlayer_field_upload_layer(); ?>
            </div>

          </div> 
        </td>
      </tr>
    </table>
      
  </fieldset>

    <fieldset class="fieldset-wrapper g-wrapper">
      <div class="gavias-heading">Layer Setting</div>
      <table style="padding: 10px 20px 20px 20px;">
        <tr>
          <td width="65%">
            <div style="float: left; width: 33%;">
              <div class="g-label">Top</div>
              <div class="g-input">
                <input type="text" name="top" placeholder="Large" class="form-text layer-option option-responsive option-lg"/>
                <input type="text" name="top_sm" placeholder="Small" class="form-text layer-option option-responsive option-sm"/>
                <input type="text" name="top_xs" placeholder="Extra Small" class="form-text layer-option option-responsive option-xs"/>
              </div>
            </div>  
            <div style="float: left; width: 32%;">  
              <div class="g-label">Left ( left/right/center/px )</div>
              <div class="g-input">
                <input type="text" name="left" placeholder="Large" class="form-text layer-option option-responsive option-lg"/>
                <input type="text" name="left_sm" placeholder="Small" class="form-text layer-option option-responsive option-sm"/>
                <input type="text" name="left_xs" placeholder="Extra Small" class="form-text layer-option option-responsive option-xs"/>
              </div>

            </div>  
            <div style="float: left; width: 33%;">
              <div class="g-label small">Link</div> 
              <input type="text" name="link" class="form-text layer-option">
            </div>
            <div style="float: left; width: 33%;">
              <div class="g-label">Custom class</div> 
              <input type="text" name="custom_class" class="form-text layer-option"/>
            </div>  
            <?php if(gavias_sliderlayer_styles()){ 
              $styles = gavias_sliderlayer_styles(); 
            ?>
              <div style="float: left; width: 33%;">
                <div class="g-label">Styles available </div> 
                <select name="custom_style" class="layer-option">
                    <?php foreach ($styles as $key => $value) { ?>
                      <option value="<?php print $key ?>"><?php print $value; ?></option>
                   <?php } ?>
                </select>
              </div>
            <?php } ?>
            <div style="float: left; width: 33%;">
                <div class="g-label">Width Layer (Image)</div> 
                <input name="width" type="text" class="form-text layer-option option-responsive option-lg" />
                <input name="width_sm" type="text" class="form-text layer-option option-responsive option-sm" />
                <input name="width_xs" type="text" class="form-text layer-option option-responsive option-xs" />
                
                <input name="height" type="hidden" class="form-text layer-option option-responsive option-lg" />
                <input name="height_sm" type="hidden" class="form-text layer-option option-responsive option-sm" />
                <input name="height_xs" type="hidden" class="form-text layer-option option-responsive option-xs" />
            </div>    
          </td>
          <td width="35%">
            <div class="g-label">Custom css</div> 
            <textarea name="custom_css" class="form-textarea layer-option" style="height:100px;"></textarea>
          </td>
        </tr>
        <tr>
        </tr>
      </table>
    </fieldset>
  
    <fieldset class="form-wrapper g-wrapper">
      <div class="gavias-heading">Layer Transition Effects</div>

      <table style="padding: 10px 20px 20px;">
        <tr>
          <td colspan="3">
            <div style="float: left; width: 75%;margin-bottom: 35px;">
              <div class="g-label" style="margin-bottom: 10px;">Data Time (Start - End)</div>
              <div id="g-slider"></div>
            </div>  
            <div style="float: right; width: 20%;margin-top:25px;">
              <input name="data_time_start" id="g_data_start" class="layer-option" type="text" style="width: 40%!important;" />
              <input name="data_time_end" id="g_data_end" class="layer-option" type="text" style="width: 40%!important;" />
            </div>
          </td>
        </tr>
        <tr>
          <td width="30%">
          <div class="g-label">Incoming Effect</div>
            <select name="incomingclasses" class="layer-option">
              <?php foreach (gaviasGetArrAnimations() as $key => $value) { ?>
                <option value="<?php print $key ?>" <?php if(isset($value['disable']) && ($value['disable']==true)) print 'disabled' ?>><?php print $value['handle']; ?></option>
              <?php } ?>
            </select>
          </td>  
          <td>
            <div class="g-label">Easing</div>
            <div><?php print gavias_defined_select('data_easing', gavias_sliderlayer_dataeasing(),'layer-option'); ?></div>
          </td>
          <td  width="30%">
            <div class="g-label">Speed Start</div>
            <input type="text" name="data_speed" class="layer-option form-text range-slider-single"/>
          </td>
        </tr>
        
        <tr>
          <td>
            <div class="g-label">Outgoing Effect</div>
            <select name="outgoingclasses" class="layer-option">
              <?php foreach (gaviasGetArrEndAnimations() as $key => $value) { ?>
                  <option value="<?php print $key ?>" <?php if(isset($value['disable']) && ($value['disable']==true)) print 'disabled' ?>><?php print $value['handle']; ?></option>
             <?php } ?>
            </select>
          </td>
          <td>
            <div class="g-label">End Easing</div>
            <?php print gavias_defined_select('data_endeasing', gavias_sliderlayer_dataendeasing(),'layer-option'); ?>
          </td>
          <td width="30%">
            <div> 
              <div class="g-label"> Speed End</div>
              <input type="text" name="data_end" class="layer-option form-text range-slider-single"/>
            </div>
          </td>
        </tr>
      </table>
    </fieldset>
    
  </div>
  <div style="clear: both;"></div>
</div>

