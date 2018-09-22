<?php
/**
 * @file
 * Contains \Drupal\dialogflow_rules\EventSubscriber\DialogFlowWebhookEventSubscriber.
 */

namespace Drupal\dialogflow_rules\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\api_ai_webhook\ApiAiEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\dialogflow_rules\Event\DialogFlowWebhookEvent;

/**
 * Event Subscriber MyEventSubscriber.
 */
class DialogFlowWebhookEventSubscriber implements EventSubscriberInterface {

  /**
   * Code that should be triggered on event specified
   */
  public function onRespond(ApiAiEvent $DfEvent) {
    $event = new DialogFlowWebhookEvent($DfEvent);
    $event_dispatcher = \Drupal::service('event_dispatcher');
    $event_dispatcher->dispatch("dialogflow_rules_webhook", $event);
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[ApiAiEvent::NAME][] = ['onRespond'];
    return $events;
  }

}