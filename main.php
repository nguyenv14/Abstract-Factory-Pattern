<?php


interface MessageInterface
{
    public function getContent(): string;
}

interface SeederInterface
{
    public function seed(): MessageInterface;
}

interface NotificationFactoryInterface
{
    public function createSeeder(): SeederInterface;
    public function createMessage(): MessageInterface;
}


class EmailMessage implements MessageInterface
{
    public function getContent(): string
    {
        return "This is an email message.";
    }
}

class EmailSeeder implements SeederInterface
{
    public function seed(): MessageInterface
    {
        return new EmailMessage();
    }
}

class SMSMessage implements MessageInterface
{
    public function getContent(): string
    {
        return "This is an SMS message.";
    }
}

class SMSSeeder implements SeederInterface
{
    public function seed(): MessageInterface
    {
        return new SMSMessage();
    }
}

class PushNotificationMessage implements MessageInterface
{
    public function getContent(): string
    {
        return "This is a push notification message.";
    }
}

class PushNotificationSeeder implements SeederInterface
{
    public function seed(): MessageInterface
    {
        return new PushNotificationMessage();
    }
}

class EmailFactory implements NotificationFactoryInterface
{
  public function createSeeder(): SeederInterface
  {
    return new EmailSeeder();
  }

  public function createMessage(): MessageInterface
  {
    return new EmailMessage();
  }
}

class SMSFactory implements NotificationFactoryInterface
{
  public function createSeeder(): SeederInterface
  {
    return new SMSSeeder();
  }

  public function createMessage(): MessageInterface
  {
    return new SMSMessage();
  }
}

class PushNotificationFactory implements NotificationFactoryInterface
{
  public function createSeeder(): SeederInterface
  {
    return new PushNotificationSeeder();
  }

  public function createMessage(): MessageInterface
  {
    return new PushNotificationMessage();
  }
}

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
