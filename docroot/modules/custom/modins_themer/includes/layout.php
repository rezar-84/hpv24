<?php
use Drupal\Core\Template\Attribute;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\FieldDefinition;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\block\Entity\Block;
use Drupal\Core\Form\FormStateInterface;
use \Drupal\Core\File\FileSystemInterface;

/**
 * Implements hook_form_FORM_ID_alter().
 */
function gavias_hook_themer_form_node_form_alter(&$form, \Drupal\Core\Form\FormStateInterface &$form_state, $form_id) {
   unset($form['gavias_blockbuilder_layout']);
   unset($form['gva_shortcode']);

   $form['gva_node_settings'] = array(
      '#type'   => 'details',
      '#title'  => t('Node Settings'),
      '#group'  => 'advanced',
      '#open'   => TRUE,
      '#access' => TRUE,
      '#attributes' => array('class' => array('node-class-form')),
   );

   $path = \Drupal::service('path.current')->getPath();
   $path_args = explode('/', $path);
   $node_id = 0;
   if (isset($path_args[1]) && isset($path_args[2]) && ($path_args[1] == 'node') && (is_numeric($path_args[2]))) {
      $node = \Drupal\node\Entity\Node::load($path_args[2]);
      if($node->id()){
         $node_id = $node->id();
      }
   }

   $form['gva_node_class']['#group']           = 'gva_node_settings';
   $form['gva_node_layout']['#group']          = 'gva_node_settings';
   $form['gva_header']['#group']               = 'gva_node_settings';
   $form['gva_box_layout']['#group']           = 'gva_node_settings';
   $form['gva_breadcrumb']['#group']           = 'gva_node_settings';
}

/**
 * Implements hook_entity_base_field_info().
 */
function gavias_hook_themer_entity_base_field_info(EntityTypeInterface $entity_type) {
   if ($entity_type->id() === 'node') {

      $fields['gva_node_layout'] = BaseFieldDefinition::create('list_string')
         ->setSetting('allowed_values', [
            'fw' => 'Fullwith no sidebar (use for block builder)',
            'fw_sidebar' => 'Fullwidth width sidebar',
            'container_sidebar' => 'Container width sidebar',
            'container_no_sidebar' => 'Container no sidebar'
         ])
         ->setLabel(t('Layout settings'))
         ->setDisplayOptions('form', array(
            'type'    => 'options_select',
            'weight'  => 1,
         ))
         ->setDisplayConfigurable('form', TRUE);

      $fields['gva_breadcrumb'] = BaseFieldDefinition::create('list_string')
         ->setSetting('allowed_values', [
            'enable'    => 'Enable',
            'disable'   => 'Disable'
         ])
         ->setLabel(t('Breadcrumb settings'))
         ->setDisplayOptions('form', array(
            'type'    => 'options_select',
            'weight'  => 2,
         ))
         ->setDisplayConfigurable('form', TRUE);  

      $fields['gva_header'] = BaseFieldDefinition::create('list_string')
         ->setSetting('allowed_values', [
            'header'    => t('Header I'),
            'header-2'  => t('Header II'),  
            'header-3'  => t('Header III')
         ])
         ->setLabel(t('Header'))
         ->setDisplayOptions('form', array(
         'type'    => 'options_select',
         'weight'  => 3,
         ))
         ->setDisplayConfigurable('form', TRUE);

      $fields['gva_node_class'] = BaseFieldDefinition::create('string')
         ->setLabel(t('CSS class(es)'))
         ->setDisplayOptions('form', array(
            'type'    => 'string_textfield',
            'weight'  => 4,
         ))
         ->setDisplayConfigurable('form', TRUE);

      $fields['gva_box_layout'] = BaseFieldDefinition::create('list_string')
         ->setSetting('allowed_values', [
            'boxed'         => t('Boxed'),
            'Wide'          => t('Wide')
         ])
         ->setLabel(t('Layout Box'))
         ->setDisplayOptions('form', array(
            'type'    => 'options_select',
            'weight'  => 5,
         ))
         ->setDisplayConfigurable('form', TRUE);
      return $fields;
   }
}


/**
 * Implements hook_form_FORM_ID_alter().
 */
function gavias_hook_themer_form_block_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id) {
   /** @var \Drupal\block\BlockInterface $block */
   $block = $form_state->getFormObject()->getEntity();
   $_id = $block->ID();
   //print "<pre>";print_r($block->getPluginId());die();
  
   // This will automatically be saved in the third party settings.
   $form['breadcrumb_background_image']['#tree'] = TRUE;
   $form['third_party_settings']['#tree'] = TRUE;
   //Add fields for breadcrumb
   // print \Drupal::config('gavias_hook_themer.settings')->get('breadcrumb_background_image_path_' . $_id);
  
  if($block->getPluginId() == 'system_breadcrumb_block'){
    
      $form['breadcrumb_background_image']['file_upload'] = array(
         '#type' => 'file',
         '#title' => t('Breadcrumb | Background Image'),
         '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif')
      );

      $form['third_party_settings']['gavias_hook_themer']['breadcrumb_background_image_path'] = array(
         '#type' => 'textfield',
         '#title' => t('Breadcrumb | Background Image Path'),
         '#default_value' => \Drupal::config('gavias_hook_themer.settings')->get('breadcrumb_background_image_path_' . $_id)
      );

      $form['third_party_settings']['gavias_hook_themer']['breadcrumb_background_color'] = array(
         '#type' => 'textfield',
         '#title' => t('Breadcrumb | Background Color'),
         '#description' => t('Setting background color for breadcrumb. eg: #f5f5f5;'),
         '#default_value' => $block->getThirdPartySetting('gavias_hook_themer', 'breadcrumb_background_color'),
      );

      $form['third_party_settings']['gavias_hook_themer']['breadcrumb_background_position'] = array(
         '#type' => 'select',
         '#title' => t('Breadcrumb | Background Position'),
         '#description' => t('Setting background position for breadcrumb.'),
         '#options' => array(
           'center top'        => t('center top'),
           'center right'      => t('center right'),
           'center bottom'     => t('center bottom'),
           'center center'     => t('center center'),
           'left top'          => t('left top'),
           'left center'       => t('left center'),
           'left bottom'       => t('left bottom'),
           'right top'         => t('right top'),
           'right center'      => t('right center'),
           'right bottom'      => t('right bottom')
         ),
         '#default_value' => $block->getThirdPartySetting('gavias_hook_themer', 'breadcrumb_background_position'),
      );

      $form['third_party_settings']['gavias_hook_themer']['breadcrumb_background_repeat'] = array(
         '#type' => 'select',
         '#title' => t('Breadcrumb | Background Repeat'),
         '#description' => t('Setting background pepeat for breadcrumb.'),
         '#options' => array(
           'no-repeat'         => t('no-repeat'),
           'repeat'            => t('repeat'),
           'repeat-x'          => t('repeat-x'),
           'repeat-y'          => t('repeat-y')
         ),
         '#default_value' => $block->getThirdPartySetting('gavias_hook_themer', 'breadcrumb_background_repeat'),
      );

      $form['third_party_settings']['gavias_hook_themer']['breadcrumb_color_style'] = array(
         '#type' => 'select',
         '#title' => t('Breadcrumb | Color Style'),
         '#description' => t('Setting color style for breadcrumb.'),
         '#options' => array(
            'text-dark'          => t('Text dark'),
            'text-light'         => t('Text light')
         ), 
         '#default_value' => $block->getThirdPartySetting('gavias_hook_themer', 'breadcrumb_color_style'),
      );

   }

   $form['third_party_settings']['gavias_hook_themer']['classes'] = array(
      '#type' => 'textfield',
      '#title' => t('CSS class(es)'),
      '#description' => t('Customize the styling of this block by adding CSS classes. Separate multiple classes by spaces.'),
      '#default_value' => $block->getThirdPartySetting('gavias_hook_themer', 'classes'),
   );

   $form['actions']['submit']['#submit'][] = 'gavias_hook_themer_form_block_form_submit';
   $form['#validate'][] = 'gavias_hook_themer_form_block_form_validate';
}

 function gavias_hook_themer_form_block_form_validate(array &$form, FormStateInterface $form_state) {
   
   $block = $form_state->getFormObject()->getEntity();
   $values = $form_state->getValues();
   
   if($block->getPluginId() == 'system_breadcrumb_block'){
      if (\Drupal::moduleHandler()->moduleExists('file')) {
         // Handle file uploads.
         $validators = array('file_validate_is_image' => array());

         // Check for a new uploaded logo.
         $file = file_save_upload('breadcrumb_background_image', $validators, FALSE, 0);
         if (isset($file)) {
            // File upload was attempted.
            if ($file) {
               // Put the temporary file in form_values so we can save it on submit.
               $form_state->setValue('breadcrumb_background_image_tmp', $file);
            }
            else {
               // File upload failed.
               $form_state->setValue('breadcrumb_background_image_tmp', '');
               $form_state->setErrorByName('breadcrumb_background_image_error', $this->t('The logo could not be uploaded.'));
            }
         }else{
               $form_state->setValue('breadcrumb_background_image_tmp', '');
         }
         $validators = array('file_validate_extensions' => array('ico png gif jpg jpeg apng svg'));
      }
   }
}

function gavias_hook_themer_form_block_form_submit(array &$form, FormStateInterface &$form_state) {
   $block = $form_state->getFormObject()->getEntity();
   $_id = $block->ID();

   if($block->getPluginId() == 'system_breadcrumb_block'){
      $values = $form_state->getValues();
      if( isset($values['breadcrumb_background_image_tmp']) && !empty($values['breadcrumb_background_image_tmp']) ) {
         //$filename = \Drupal::service('file_system')->copy($values['breadcrumb_background_image_tmp']->getFileUri(), 'public://breadcrumb-image', FileSystemInterface::EXISTS_REPLACE);
         $filename = \Drupal::service('file_system')->copy($values['breadcrumb_background_image_tmp']->getFileUri(), 'public://breadcrumb-' . $values['breadcrumb_background_image_tmp']->getFileName(), FileSystemInterface::EXISTS_RENAME);
         if (!empty($filename)) {
            \Drupal::configFactory()->getEditable('gavias_hook_themer.settings')
            ->set('breadcrumb_background_image_path_' . $_id, gavias_hook_themer_validate_path($filename))
            ->save();
         }
      }else{
         $default_value = isset($values['third_party_settings']['gavias_hook_themer']['breadcrumb_background_image_path']) ? $values['third_party_settings']['gavias_hook_themer']['breadcrumb_background_image_path'] : '';
         \Drupal::configFactory()->getEditable('gavias_hook_themer.settings')
            ->set('breadcrumb_background_image_path_' . $_id, $default_value)
            ->save();
      }
   }
}    

function gavias_hook_themer_validate_path($path) {
   // Absolute local file paths are invalid.
   if (\Drupal::service('file_system')->realpath($path) == $path) {
      return FALSE;
   }
   // A path relative to the Drupal root or a fully qualified URI is valid.
   if (is_file($path)) {
      return $path;
   }
   // Prepend 'public://' for relative file paths within public filesystem.
   if (file_uri_scheme($path) === FALSE) {
      $path = 'public://' . $path;
   }
   if (is_file($path)) {
      return $path;
   }
   return FALSE;
}