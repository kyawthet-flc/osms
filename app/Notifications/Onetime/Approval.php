<?php

namespace App\Notifications\Onetime;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\Task\Onetime\OnetimeApplication;

class Approval extends Notification implements ShouldQueue
{
    use Queueable;
    
    protected $subject;

    protected $body;

    protected $application;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(OnetimeApplication $onetimeApplication,$subject, $body)
    {
        $this->subject = $subject;
        $this->body    = $body;
        $this->application    = $onetimeApplication;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
            'subject' => $this->subject,
            'body' => $this->body
        ];
    }
}
