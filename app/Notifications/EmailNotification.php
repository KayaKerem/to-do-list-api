<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailNotification extends Notification
{
    use Queueable;

    protected $user;


    public function __construct($user)
    {
        $this->user = $user;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $data = [
            'greeting' => 'Hi '.$this->user->name.',',
            'body' => 'Welcome to todolists api',
            'thanks' => 'Thank you for choosing us',
            'actionText' => strval(random_int(100000, 999999)),
            'actionURL' => url('/'),
            'id' => 57
        ];
        return (new MailMessage)
            ->greeting($data['greeting'])
            ->line($data['body'])
            ->action($data['actionText'], $data['actionURL'])
            ->line($data['thanks']);
    }



    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
