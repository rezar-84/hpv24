<?php

namespace Drupal\webform_telegram_notify\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\Entity\Webform;

class TelegramSettingsForm extends ConfigFormBase {

  public function getFormId() {
    return 'webform_telegram_notify_settings';
  }

  protected function getEditableConfigNames() {
    return ['webform_telegram_notify.settings'];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webform_telegram_notify.settings');

    $form['telegram_bot_token'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Telegram Bot Token'),
      '#default_value' => $config->get('telegram_bot_token'),
      '#required' => TRUE,
    ];

    $form['telegram_chat_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Telegram Chat ID'),
      '#default_value' => $config->get('telegram_chat_id'),
      '#required' => TRUE,
    ];

    // Fetch all webforms for the dropdown list
    $webforms = Webform::loadMultiple();
    $webform_options = [];
    foreach ($webforms as $webform) {
      $webform_options[$webform->id()] = $webform->label();
    }

    $form['specific_webform_id'] = [
      '#type' => 'select',
      '#title' => $this->t('Specific Webform'),
      '#default_value' => $config->get('specific_webform_id'),
      '#options' => $webform_options,
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $this->config('webform_telegram_notify.settings')
      ->set('telegram_bot_token', $form_state->getValue('telegram_bot_token'))
      ->set('telegram_chat_id', $form_state->getValue('telegram_chat_id'))
      ->set('specific_webform_id', $form_state->getValue('specific_webform_id'))
      ->save();
  }

}
