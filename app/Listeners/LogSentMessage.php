<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Model\SystemLog\MailLog;

class LogSentMessage
{
    protected $message;
    protected $data;

    // public function __construct(Swift_Message $message, array $data = [])
    // {
    //     $this->message = $message;
    //     $this->data = $data;
    // }

    public function handle($event)
    {
        // if($event->message->getSubject() != 'Verification Required'){
            MailLog::create([
                'subject' => $event->message->getSubject(),
                'from_email' => key($event->message->getFrom()),
                'to_email' => key($event->message->getTo()),
                'header' => $event->message->getHeaders()->toString(), 
                'body' => $event->message->getBody(),
                'status' => 'unchecked'
            ]);
        // }
    }
}