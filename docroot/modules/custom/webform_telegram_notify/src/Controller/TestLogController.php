<?php

namespace Drupal\webform_telegram_notify\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;

class TestLogController extends ControllerBase {
  protected $logger;

  public function __construct(LoggerChannelFactoryInterface $logger_factory) {
    $this->logger = $logger_factory->get('webform_telegram_notify');
  }

  public static function create(ContainerInterface $container) {
    return new static($container->get('logger.factory'));
  }

  public function logTest() {
    $this->logger->info('Test log entry from TestLogController.');
    return ['#markup' => $this->t('Test log entry created. Check dblog.')];
  }
}
