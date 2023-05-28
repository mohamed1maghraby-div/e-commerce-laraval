<?php

namespace App\Notifications\Backend\Orders;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array // person who recive notification
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    //public function toMail(object $notifiable): MailMessage
    //{
    //    return (new MailMessage)
    //                ->line('The introduction to the notification.')
    //                ->action('Notification Action', url('/'))
    //                ->line('Thank you for using our application!');
    //}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_ref' => $this->order->ref_id,
            'last_transaction' => $this->order->status($this->order->transactions()->latest()->first()->transaction),
            'order_url' => route('customer.orders'),
            'created_date' => $this->order->transactions()->latest()->first()->created_at->format('M d, Y')
        ];
    }
    public function toBroadcast(object $notifiable)
    {
        return new BroadcastMessage([
            'data' => [
                'order_id' => $this->order->id,
                'order_ref' => $this->order->ref_id,
                'last_transaction' => $this->order->status($this->order->transactions()->latest()->first()->transaction),
                'order_url' => route('customer.orders'),
                'created_date' => $this->order->transactions()->latest()->first()->created_at->format('M d, Y')
            ]
        ]);
    }
}
