<?php

namespace App\Notifications;

use App\Models\Order;
use Broadcast;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public  Order $order)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {

        return [FcmChannel::class];

        return ['mail' ,'database', 'broadcast'];

        $channels = ['database'];

        if($notifiable->notification_preference['order_created']['sms'] ?? false)
        {
            $channels[] ='vonage';
        }
        if($notifiable->notification_preference['order_created']['mail'] ?? false)
        {
            $channels[] ='mail';
        }
        if($notifiable->notification_preference['order_created']['broadcast'] ?? false)
        {
            $channels[] ='broadcast';
        }
        return $channels;



    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        $addr = $this->order->billingAddress;
        return[
            'body' => "A new Order (#{$this->order->number}) created by {$addr->name} form {$addr->country_name}",
            'icon' => 'fas fa-file',
            'url' => route('home'),
            'order_id' => $this->order->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        $addr = $this->order->billingAddress;
        return new BroadcastMessage([
            'body' => "A new Order (#{$this->order->number}) created by {$addr->name} form {$addr->country_name}",
            'icon' => 'fas fa-file',
            'url' => route('home'),
            'order_id' => $this->order->id,
        ]);
    }

    public function toFcm($notifiable): FcmMessage
    {
        $addr = $this->order->billingAddress;
        return (new FcmMessage(notification: new FcmNotification(
                title: 'Account Activated',
                body: "A new Order (#{$this->order->number}) created by {$addr->name} form {$addr->country_name}",
                image: 'http://example.com/url-to-image-here.png'
            )))
            ->data([
                'order_id' => $this->order->id,
            ])
            ->custom([
                'android' => [
                    'notification' => [
                        'color' => '#0A0A0A',
                    ],
                    'fcm_options' => [
                        'analytics_label' => 'analytics',
                    ],
                ],
                'apns' => [
                    'fcm_options' => [
                        'analytics_label' => 'analytics',
                    ],
                ],
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
