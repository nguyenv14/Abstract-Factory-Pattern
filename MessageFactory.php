<?php
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
