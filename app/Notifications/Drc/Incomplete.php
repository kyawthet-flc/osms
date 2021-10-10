<?php

namespace App\Notifications\Drc;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\Task\Drc\DrcApplication;

class Incomplete extends Notification implements ShouldQueue
{
    use Queueable;

    protected $drcApplication;
    protected $title;
    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(DrcApplication $drcApplication, $title, $comment)
    {
        $this->drcApplication = $drcApplication;
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
                    ->line('Incomplete')
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
