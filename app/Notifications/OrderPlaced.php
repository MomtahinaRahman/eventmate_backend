<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
class OrderPlaced extends Notification implements ShouldQueue
{
    use Queueable;
    private $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        //
        $this->oder= $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['database','broadcast'];
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toDatabase($notifiable) 
    {
        return [
            //'repliedTime'=>Carbon::now()
            'order'=>$this->order,
            'vendor'=>$notifiable,
            'data'=>"helloooo"
        ];
    }

    // public function toBroadcast($notifiable)
    // {
    //     return [
    //         //'repliedTime'=>Carbon::now()
    //         'user'=>$this->user,
    //         'vendor'=>$notifiable,
    //         'data'=>"helloooo"
    //     ];
    // }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }

    public function broadcastType()
    {
        return 'new-order';
    }

    //public function toMail($notifiable)
    //{
    //    return (new MailMessage)
    //                ->line('The introduction to the notification.')
    //                ->action('Notification Action', url('/'))
    //                ->line('Thank you for using our application!');
    //}

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }

    // public function toArray($notifiable)
    // {
    //      return [
    //         'post' => [
    //             'id' => $this->comment->post_id,
    //         ],
    //         'author' => [
    //             'id' => $this->comment->user_id,
    //             'first_name' => $this->comment->user->first_name,
    //             'last_name' => $this->comment-user->last_name,
    //         ],
    //         'comment' => [
    //             'id' => $this->comment->id,
    //             'body' => $this->comment->body,
    //             'commented_at' => $this->comment->commented_at,
    //         ],
    //     ];
    //  }
    public function toArray($notifiable)
    {
         return [
            'post' => [
                'id' => '01',
            ],
            'author' => [
                'id' => '01',
                'first_name' => 'mahir',
                'last_name' => 'sadman',
            ],
            'comment' => [
                'id' => '01',
                'body' => 'new order placed',
                'commented_at' => '01',
            ],
        ];
     }
}
