<?php

namespace Drupal\webform_telegram_notify\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\webform\WebformSubmissionInterface;
use Drupal\webform\Plugin\WebformHandlerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use GuzzleHttp\ClientInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

class WebformSubmissionSubscriber implements EventSubscriberInterface {

  protected $logger;
  protected $httpClient;
  protected $configFactory;

  public function __construct(LoggerChannelFactoryInterface $logger_factory, ClientInterface $http_client, ConfigFactoryInterface $config_factory) {
    $this->logger = $logger_factory->get('webform_telegram_notify');
    $this->httpClient = $http_client;
    $this->configFactory = $config_factory;
  }

  public static function getSubscribedEvents() {
    $events['webform.webform_submission.insert'][] = ['onWebformSubmissionInsert'];
    return $events;
  }

  public function onWebformSubmissionInsert(WebformHandlerInterface $handler, WebformSubmissionInterface $submission) {
    $config = $this->configFactory->get('webform_telegram_notify.settings');
    $specificWebformId = $config->get('specific_webform_id');
    $webformId = $submission->getWebform()->id();

    // Log the event trigger
    $this->logger->info('Webform submission event triggered for webform ID: @webformId', ['@webformId' => $webformId]);

    if ($webformId === $specificWebformId) {
      $this->logger->info('Webform ID matches specific webform ID: @specificWebformId', ['@specificWebformId' => $specificWebformId]);

      $data = $submission->getData();
      $message = "New webform submission on $webformId:\n";
      foreach ($data as $key => $value) {
        $message .= "$key: $value\n";
      }
      $this->logger->info('Sending message to Telegram: @message', ['@message' => $message]); // Log the message
      $this->sendMessageToTelegram($message);
    } else {
      $this->logger->info('Webform ID does not match specific webform ID: @specificWebformId', ['@specificWebformId' => $specificWebformId]);
    }
  }

  protected function sendMessageToTelegram($message) {
    $config = $this->configFactory->get('webform_telegram_notify.settings');
    $telegramBotToken = $config->get('telegram_bot_token');
    $telegramChatId = $config->get('telegram_chat_id');

    $this->logger->info('Attempting to send Telegram message. Bot Token: @botToken, Chat ID: @chatId', ['@botToken' => $telegramBotToken, '@chatId' => $telegramChatId]);

    try {
      $response = $this->httpClient->post("https://api.telegram.org/bot{$telegramBotToken}/sendMessage", [
        'json' => [
          'chat_id' => $telegramChatId,
          'text' => $message,
        ],
      ]);
      $this->logger->info('Telegram message sent successfully: @message', ['@message' => $message]);
    }
    catch (\Exception $e) {
      $this->logger->error('Failed to send Telegram message: @error', ['@error' => $e->getMessage()]);
    }
  }

}
