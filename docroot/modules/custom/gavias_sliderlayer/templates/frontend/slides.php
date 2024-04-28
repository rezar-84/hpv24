<?php 
  $_id=gavias_sliderlayer_makeid();
  $ss = json_decode($ss);
  $ss_settings = json_decode($ss_settings);
?>
<div <?php print $attributes;?> data-source="gallery">
   <div id="slider-<?php print $_id; ?>" class="rev_slider fullwidthabanner" data-version="5.4.8.1">
      <ul>
         <?php print $content;?>
         
      </ul>
      <div class="tp-bannertimer tp-top"></div>
   </div>
</div>


<script type="text/javascript">

jQuery(document).ready(function($){
    jQuery("#slider-<?php print $_id ?>").show().revolution({
      sliderType:"standard",
      sliderLayout:"<?php print $ss->sliderLayout ?>",
      dottedOverlay:"<?php print $ss->dottedOverlay ?>",
      delay: <?php print $ss->delay ?>,
      minHeight: <?php print $ss->minHeight ?>,
      fullScreenAutoWidth: "auto",
      fullScreenAlignForce: "off",
      fullScreenOffset: "0",
      visibilityLevels:[1240,1024,778,480],
      <?php if($ss->reponsive){ ?>
        responsiveLevels:<?php print $ss->responsiveLevels ?>,
      <?php } ?>
      gridwidth:<?php print $ss->gridwidth ?>,
      gridheight:<?php print $ss->gridheight ?>,
      lazyType:"none",
      shadow:<?php print $ss->shadow ?>,
      spinner:"spinner0",
      stopLoop:"off",
      stopAfterLoops:-1,
      stopAtSlide:-1,
      shuffle:"off",
      autoHeight:"off",
      disableProgressBar:"<?php print $ss->disableProgressBar ?>",
      hideThumbsOnMobile:"off",
      hideSliderAtLimit:0,
      hideCaptionAtLimit:0,
      hideAllCaptionAtLimit: 0,
      debugMode:false,
      parallax:{
        type: 'mouse',
        origo: 'slidercenter',
        speed: 2000,
        levels: [4,5,6,7,12,16,10,50,46,47,48,49,50,55],
      },
      navigation: {
        keyboardNavigation:"off",
        keyboard_direction: "horizontal",
        mouseScrollNavigation:"off",
        mouseScrollReverse:"default",
        onHoverStop:"<?php print $ss->navigation->onHoverStop ?>",
        touch:{
          touchenabled:"on",
          touchOnDesktop:"on",
          swipe_threshold: 75,
          swipe_min_touches: 50,
          swipe_direction: "horizontal",
          drag_block_vertical: false
        },
        arrows: {
          style:"gyges",
          enable: <?php print $ss->navigation->arrows->enable ?>,
          hide_delay:200,
          hide_delay_mobile: 1200,
          tmp:'',
          left: {
            h_align:"<?php print $ss->navigation->arrows->left->h_align ?>",
            v_align:"<?php print $ss->navigation->arrows->left->v_align ?>",
            h_offset:<?php print $ss->navigation->arrows->left->h_offset ?>,
            v_offset:<?php print $ss->navigation->arrows->left->v_offset ?>
          },
          right: {
            h_align:"<?php print $ss->navigation->arrows->right->h_align ?>",
            v_align:"<?php print $ss->navigation->arrows->right->v_align ?>",
            h_offset:<?php print $ss->navigation->arrows->right->h_offset ?>,
            v_offset:<?php print $ss->navigation->arrows->right->v_offset ?>
          }
        },
        bullets: {
          enable:<?php print $ss->navigation->bullets->enable ?>,
          hide_onmobile:false,
          hide_onleave:false,
          direction:"horizontal",
          h_align:"<?php print $ss->navigation->bullets->h_align ?>",
          v_align:"<?php print $ss->navigation->bullets->v_align ?>",
          h_offset:0,
          v_offset:20,
          space: 10
        }
      },
      fallbacks: {
        simplifyAll: "off",
        nextSlideOnWindowFocus: "off",
        disableFocusListener: true,
      }
    });
});

</script>

