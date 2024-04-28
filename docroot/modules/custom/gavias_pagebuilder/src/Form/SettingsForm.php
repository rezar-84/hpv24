<?php

namespace Drupal\gavias_pagebuilder\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\NodeType;
use Drupal\Core\Url;
/**
 * Class SettingsForm.
 *
 * @package Drupal\gavias_pagebuilder\Form
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'gavias_pagebuilder.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'gavias_pagebuilder_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('gavias_pagebuilder.settings');
    $weights_range = range(-10, 10);
    $weights = array_combine($weights_range, $weights_range);
    $form['gva_edit_save'] = [
      '#type' => 'select',
      '#title' => $this->t('Enable Save Edit Button, it will hidden default Save Button of Drupal Core'),
      '#options'  => array(
        'enable' => t('Enable'),
        'disable' => t('Disable')
      ),
      '#default_value' => $config->get('gva_edit_save') ?: 'disable',

    ];

    $node_types = NodeType::loadMultiple();
    $keyed_node_types = [];
    foreach ($node_types as $content_type) {
      $keyed_node_types[$content_type->id()] = $content_type->label();
    }
    $default_value_node_types = $config->get('node_types');
    $form['node_types'] = [
      '#type' => 'checkboxes',
      '#options' => $keyed_node_types,
      '#title' => $this->t('Node types'),
      '#description' => $this->t('Set the node types you want use page builder.'),
      '#default_value' => isset($default_value_node_types) ? $default_value_node_types : ['page'],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $this->config('gavias_pagebuilder.settings')
      ->set('node_types', $form_state->getValue('node_types'))
      ->set('gva_edit_save', $form_state->getValue('gva_edit_save'))
      ->save();
  }

}
