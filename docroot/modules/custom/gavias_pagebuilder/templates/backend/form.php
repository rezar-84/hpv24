<?php 
  use Drupal\Core\Url;
  global $base_url;
?>

<script src="<?php echo base_path()  . \Drupal::service('extension.list.module')->getPath('gavias_pagebuilder')  ?>/assets/admin/js/app.min.js"></script>

<div id="gavias-pagebuider-wrap-settings">
   
   <div class="gbb-block-title">
    <strong><?php print 'Edit: ' ?><?php print $gbb_title ?> ( ID: <?php print $gbb_id ?> | <a href="<?php print Url::fromRoute('gavias_pagebuilder.admin.import', array('bid' => $gbb_id))->toString() ?>">Import</a> | <a href="<?php print Url::fromRoute('gavias_pagebuilder.admin.export', array('bid' => $gbb_id))->toString(); ?>">Export</a> )</strong>
   </div>

  <form method="POST" id="gpb_form-content-change" class="form-horizontal" enctype="multipart/form-data">
    <textarea class="hidden" id="gpb-content--data" name="content"></textarea>
    <div id="gpb_content-bottom">
      <div class="action-add-row">
        <a href="#" id="gpb_add-element" class="gpb_add-element"><i class="fa fa-plus-square-o"></i></a>
        <a href="#" id="gpb_add-element-import" class="gpb_add-element-import"><i class="fa fa-plus-square-o"></i> Add Row with Import</a>
        <div class="row-import hidden">
          <textarea rows="6" id="row-import-data" name="row-import-data"></textarea>
          <a href="#" class="button" id="gpb_add-element-import-submit">Import Row</a>
        </div>
      </div>
    </div>
    <div class="action-form">
      <?php if($url_redirect){ ?>
        <a id="check-submit" target="_blank" href="<?php print $url_redirect ?>" class="button button-action button--small" style="float: right;"><?php print t('Back to Page') ?></a>
      <?php } ?>  
      <button id="check-submit" class="button button-action button--primary button--small" type="submit"><?php print t('Save Configuration') ?></button>
    </div>
    <input type="hidden" value="<?php print $bid ?>" id="gavias_pagebuilder_id" name="gavias_pagebuilder_id" />
  </form>
  <?php ob_start() ?>
  <?php $output = ob_get_clean() ?>  
  <?php print $output ?>
</div>  
