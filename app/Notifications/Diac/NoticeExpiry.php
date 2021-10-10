<?php

namespace App\Notifications\Diac;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\Task\Diac\DiacApplication;

class NoticeExpiry extends Notification implements ShouldQueue
{
    use Queueable;

    protected $diacApplication;
    protected $title;
    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(DiacApplication $diacApplication, $title, $comment)
    {
        $this->diacApplication = $diacApplication;
        $this->title = $title;
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Expiry Notice Alert.')
                    ->subject($this->title)
                    ->line($this->comment)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
