<?php
function gavias_hook_themer_get_blocks_options() {
  static $_blocks_array = array();
  if (empty($_blocks_array)) {
    // Get default theme for user.
    $theme_default = \Drupal::config('system.theme')->get('default');
    // Get storage handler of block.
    $block_storage = \Drupal::entityTypeManager()->getStorage('block');
    // Get the enabled block in the default theme.
    $entity_ids = $block_storage->getQuery()->condition('theme', $theme_default)->execute();
    $entities = $block_storage->loadMultiple($entity_ids);
    $_blocks_array = [];
    foreach ($entities as $block_id => $block) {
      //if ($block->get('settings')['provider'] != 'tb_megamenu') {
        $_blocks_array[$block_id] = $block->label();
      //}
    }
    asort($_blocks_array);
  }
  return $_blocks_array;
}

function gavias_hook_themer_render_block($key) {
   $block = \Drupal\block\Entity\Block::load($key);
   $block_content = \Drupal::entityTypeManager()
      ->getViewBuilder('block')
      ->view($block);
   return drupal_render($block_content);
}