<?php

/**
 * @file
 * Contains \Drupal\gavias_pagebuilder\Derivative\GaviasPageBuilderBlock.
 */

namespace Drupal\gavias_pagebuilder\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Plugin\Discovery\ContainerDeriverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides blocks which belong to Gavias Blockbuilder.
 */
class GaviasPageBuilderBlock extends DeriverBase {
  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    if(\Drupal::database()->schema()->tableExists('gavias_pagebuilder')){
      $results = \Drupal::database()->select('{gavias_pagebuilder}', 'd')
            ->fields('d', array('id', 'title'))
            ->execute();

      foreach ($results as $row) {
        $this->derivatives['gavias_pagebuilder_block____' . $row->id] = $base_plugin_definition;
        $this->derivatives['gavias_pagebuilder_block____' . $row->id]['admin_label'] = 'Gavias Content Builder - ' . $row->title;
      }
    }
    return $this->derivatives;
  }
}
