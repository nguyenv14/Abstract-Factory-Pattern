<?php

require_once 'MessageInterface.php';

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

?>