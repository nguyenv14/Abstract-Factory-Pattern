<?php

// Abstract Factory Pattern Example

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

?>