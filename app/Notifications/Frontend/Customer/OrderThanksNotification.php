<?php

namespace App\Notifications\Frontend\Customer;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderThanksNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    public $attachment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, $attachment)
    {
        $this->order = $order;
        $this->attachment = $attachment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $channels = ['broadcast', 'database'];
        if($notifiable->receive_emails){
            $channels[] = 'mail';
        }
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('Dear, ' . $notifiable->full_name)
                    ->line('Yhank you for purchase the order.')
                    ->line('Thank you for using our application!')
                    ->attach($this->attachment, [
                        'as' => 'order-' . $this->order->ref_id . '.pdf',
                        'mime' => 'application/pdf'
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

    public function toDatabase(object $notifiable): array
    {
        return [
            'customer_name' => $this->order->user->full_name,
            'order_ref' => $this->order->ref_id,
            'order_url' => route('customer.orders'),
            'created_date' => $this->order->created_at->format('M d, Y')
        ];
    }
    public function toBroadcast(object $notifiable)
    {
        return new BroadcastMessage([
            'data' => [
                'customer_name' => $this->order->user->full_name,
                'order_ref' => $this->order->ref_id,
                'order_url' => route('customer.orders'),
                'created_date' => $this->order->created_at->format('M d, Y')
            ]
        ]);
    }
}
