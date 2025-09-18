<?php
//////////////////////////
// Interfaces
//////////////////////////
interface IMessage {
    public function getContent(): string;
}

interface ISender {
    public function send(IMessage $message): void;
}

interface IMessengerFactory {
    public function createMessage(string $text): IMessage;
    public function createSender(): ISender;
}

//////////////////////////
// Zalo
//////////////////////////
class ZaloMessage implements IMessage {
    private string $text;
    public function __construct(string $text) { $this->text = $text; }
    public function getContent(): string { return "[Zalo] " . $this->text; }
}

class ZaloSender implements ISender {
    public function send(IMessage $message): void {
        echo "📩 Gửi qua Zalo: " . $message->getContent() . PHP_EOL;
    }
}

class ZaloFactory implements IMessengerFactory {
    public function createMessage(string $text): IMessage { return new ZaloMessage($text); }
    public function createSender(): ISender { return new ZaloSender(); }
}

//////////////////////////
// Slack
//////////////////////////
class SlackMessage implements IMessage {
    private string $text;
    public function __construct(string $text) { $this->text = $text; }
    public function getContent(): string { return "[Slack] " . $this->text; }
}

class SlackSender implements ISender {
    public function send(IMessage $message): void {
        echo "📩 Gửi qua Slack: " . $message->getContent() . PHP_EOL;
    }
}

class SlackFactory implements IMessengerFactory {
    public function createMessage(string $text): IMessage { return new SlackMessage($text); }
    public function createSender(): ISender { return new SlackSender(); }
}

//////////////////////////
// Teams
//////////////////////////
class TeamsMessage implements IMessage {
    private string $text;
    public function __construct(string $text) { $this->text = $text; }
    public function getContent(): string { return "[Teams] " . $this->text; }
}

class TeamsSender implements ISender {
    public function send(IMessage $message): void {
        echo "📩 Gửi qua Teams: " . $message->getContent() . PHP_EOL;
    }
}

class TeamsFactory implements IMessengerFactory {
    public function createMessage(string $text): IMessage { return new TeamsMessage($text); }
    public function createSender(): ISender { return new TeamsSender(); }
}

//////////////////////////
// NotificationService (Client)
//////////////////////////
class NotificationService {
    private IMessengerFactory $factory;
    public function __construct(IMessengerFactory $factory) { $this->factory = $factory; }

    public function notify(string $text): void {
        $message = $this->factory->createMessage($text);
        $sender = $this->factory->createSender();
        $sender->send($message);
    }
}

//////////////////////////
// Demo
//////////////////////////
echo "=== Demo gửi thông báo đa kênh ===\n";

$zalo = new NotificationService(new ZaloFactory());
$zalo->notify("Xin chào từ hệ thống!");

$slack = new NotificationService(new SlackFactory());
$slack->notify("Có bug mới được tạo.");

$teams = new NotificationService(new TeamsFactory());
$teams->notify("Cuộc họp bắt đầu lúc 10h sáng.");
