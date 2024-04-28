<?php

/**
 * @file
 * Contains \Drupal\gavias_pagebuilder\Plugin\Block\GaviasPageBuilderBlock.
 */

namespace Drupal\gavias_pagebuilder\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides blocks which belong to Gavias Block Builder.
 *
 *
 * @Block(
 *   id = "gavias_pagebuilder_block",
 *   admin_label = @Translation("Gavias Block Builder"),
 *   category = @Translation("Gavias Block Builder"),
 *   deriver = "Drupal\gavias_pagebuilder\Plugin\Derivative\GaviasPageBuilderBlock",
 * )
 *
 */

class GaviasPageBuilderBlock extends BlockBase {

  protected $bid;

  /**
   * {@inheritdoc}
   */
  public function build() {
    $bid = $this->getDerivativeId();
    $this->bid = $bid;
     $block = array();
      if (str_replace('gavias_pagebuilder_block____', '', $bid) != $bid) {
        $bid = str_replace('gavias_pagebuilder_block____', '', $bid);
        $results = gavias_pagebuilder_load($bid);
        if(!$results) return 'No block builder selected';
        $content_block = gavias_pagebuilder_frontend($results->params);
        $user = \Drupal::currentUser();
        $url = \Drupal::request()->getRequestUri();
        $edit_url = '';
        if($user->hasPermission('administer gavias_pagebuilder')){
          $edit_url = Url::fromRoute('gavias_pagebuilder.admin.edit', array('bid' => $bid, 'destination' =>  $url))->toString();
        }
        $block = array(
          '#theme' => 'builder',
          '#content' => $content_block,
          '#edit_url' => $edit_url,
          '#cache' => array('max-age' => 0)
        );
      }

      return $block;
  }
  /**
   *  Default cache is disabled. 
   * 
   * @param array $form
   * @param \Drupal\gavias_pagebuilder\Plugin\Block\FormStateInterface $form_state
   * @return 
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $rebuild_form = parent::buildConfigurationForm($form, $form_state);
    $rebuild_form['cache']['max_age']['#default_value'] = 0;
    return $rebuild_form;
  }
}
