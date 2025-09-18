<?php

require_once 'MessageInterface.php';
require_once 'MessageClass.php';
require_once 'MessageFactory.php';

class NotificationService
{
  private NotificationFactoryInterface $factory;

  public function __construct(NotificationFactoryInterface $factory)
  {
    $this->factory = $factory;
  }

  public function sendNotification(): void
  {
    $seeder = $this->factory->createSeeder();
    $message = $seeder->seed();
    echo $message->getContent() . PHP_EOL;
  }
}


// Client code
$emailFactory = new EmailFactory();
$smsFactory = new SMSFactory();
$pushFactory = new PushNotificationFactory();

$emailService = new NotificationService($emailFactory);
$smsService = new NotificationService($smsFactory);
$pushService = new NotificationService($pushFactory);

$emailService->sendNotification(); // Output: This is an email message.
$smsService->sendNotification();   // Output: This is an SMS message.
$pushService->sendNotification();  // Output: This is a push notification message.
