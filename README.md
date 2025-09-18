# 🏭 Hệ thống Giao Tiếp Đa Nền tảng - áp dụng Abstract Factory pattern

## 📌 Mục tiêu

Dự án này minh họa cách áp dụng **mẫu thiết kế Abstract Factory** để xây dựng **hệ thống thông báo đa Nền tảng (Email, SMS, Push)**.  
Trọng tâm là **tách rời logic nghiệp vụ với các Nền tảng thông báo cụ thể**, giúp hệ thống **linh hoạt, dễ mở rộng và bảo trì**.

## ⚡ Vấn đề đặt ra

Giả sử ứng dụng cần gửi thông báo qua nhiều Nền tảng:

- 📧 Zalo
- 📱 Slack
- 📢 MS Teams

Mỗi Nền tảng cần có 2 thành phần:

- `Message` (xây nội dung thông báo đúng định dạng Nền tảng)
- `Sender` (thực hiện gửi nội dung đó đi qua đúng giao thức)

Nếu code trực tiếp như sau (sau này cần sửa code này lại cho đúng với code dự án mình):

```php
if ($platform === 'zalo') {
        echo "📩 Gửi qua Zalo: [Zalo] $text\n";
        // Gọi API Zalo tại đây
    }
    else if ($platform === 'slack') {
        echo "📩 Gửi qua Slack: [Slack] $text\n";
        // Gọi Slack webhook tại đây
    }
   ...
```

thì sẽ phát sinh vấn đề:

❌ Khó bảo trì: thêm một Nền tảng mới phải sửa ở nhiều nơi

❌ Rối rắm quan hệ: phải tự nhớ ghép đúng Message với Sender cùng loại

❌ Không thể mở rộng linh hoạt: client code phụ thuộc vào class cụ thể (Concrete class)

## ✅Dùng Abstract Factory

```php
$service = new NotificationService(new ZaloFactory());
$service->notify("Xin chào");

$service = new NotificationService(new SlackFactory());
$service->notify("Có bug mới");

$service = new NotificationService(new TeamsFactory());
$service->notify("Họp lúc 10h");
```

## 🏭 Lợi ích khi dùng Abstract Factory

Abstract Factory giải quyết triệt để các vấn đề trên bằng cách:

- Gom các đối tượng liên quan (Message + Sender) của từng Nền tảng vào một “gia đình” sản phẩm (product)
- Cung cấp một interface duy nhất để tạo ra đúng nhóm đối tượng phù hợp với từng Nền tảng
- Cho phép thay đổi toàn bộ nhóm sản phẩm chỉ bằng cách đổi factory, không sửa logic nghiệp vụ

📌 Chỉ cần đổi new SlackFactory() thành new ZaloFactory() → Toàn bộ hệ thống tự chuyển sang gửi qua Zalo, không đổi code client.

## 🏗️ Cấu trúc logic

- IMessage: tạo nội dung phù hợp nền tảng
- ISender: gửi thông báo qua nền tảng
- IMessengerFactory: Abstract Factory tạo ra IMessage + ISender
- MessengerFactory, ZaloFactory, - SlackFactory, TelegramFactory, PushFactory: các Concrete Factory
- NotificationService: client sử dụng factory để gửi thông báo

## 💡 Lợi ích

- Tách biệt logic gửi thông báo với loại Nền tảng cụ thể -> Client code không phụ thuộc vào class cụ thể → dễ mở rộng
- Dễ thêm nền tảng mới (Telegram, Discord, Slack, …) -> Thêm Nền tảng mới chỉ cần thêm một Concrete Factory mới
- Đảm bảo sử dụng đúng cặp Message và Sender theo từng Nền tảng (Đảm bảo các đối tượng liên quan trong cùng một Nền tảng luôn đồng bộ với nhau)

## 📦 Mở rộng

Để thêm một Nền tảng mới (ví dụ: Slack):

1. Tạo `TelegramMessage` implements `IMessage`
2. Tạo `TelegramSender` implements `ISender`
3. Tạo `TelegramFactory` implements `INotificationFactory`

Sau đó chỉ cần:

```php
$service = new NotificationService(new TelegramFactory());
$service->notify("Xin chào từ Telegram!");
```

Không cần sửa bất kỳ dòng code cũ nào — đây chính là ưu điểm lớn nhất của Abstract Factory.
