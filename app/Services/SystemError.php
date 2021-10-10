<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

/* 
 $statusCode = $exception->getCode() == 0 ? 200 : $exception->getCode();
 dd($statusCode); 
*/

class SystemError {

    protected $exception;

    public function __construct($exception)
    {
        $this->exception = $exception;    
    }

    public function report()
    {  
        $statusCode = $this->exception->getCode() == 0 ? 200 : $this->exception->getCode();
       
       
       /*  dd(  
            $statusCode, 
            // $this->exception->getStatusCode(),
            $this->exception, 
            $this->exception->getStatusCode(),
            $this->exception->getCode(),
            $this->exception->getMessage(),
            $this->exception->getFile(),
            $this->exception->getLine() 
        );  */
        $mails = array(
            'kyawthet.2017.flc@gmail.com',
            'kyawthet@securelinkmm.com'
        );

        if (  count($mails) > 0 ) {

            $date = now()->format('D, d-m-Y');

            $errorMessage = "<p><i>Date</i>:<b style='color: #333;font-weight: bold;'> " . $date . "</b></p>";

            if( method_exists( $this->exception, 'getStatusCode') ) {
                // $ddd = $this->exception->getStatusCode();
                $title = ' 404 ERROR APPEARING.';
                $errorMessage .= "<p>Error Message:<b style='color: red;font-weight: bold;'>Just 404 Error!</b></p>";
                $errorMessage .= "<p><b style='color: red;font-weight: bold;'>You dont need to do any thing!</b></p>";
            } else {

                $title = ' ERROR APPEARING[Urgent].';
                $errorMessage .= "<p>Error Message:<b style='color: red;font-weight: bold;'> " . $this->exception->getMessage() . "</b></p>";
                $errorMessage .= "<p>File: <b style='color: red;font-weight: bold;'>" . $this->exception->getFile() . "</b></p>";
                $errorMessage .= "<p>Line No: <b style='color: red;font-weight: bold;'>" . $this->exception->getLine() . "</b></p>";

            }

            $fromEmail = config('mail.from.address');
            $appName = config('app.name');

            foreach ($mails as $key => $toMail) {
                Mail::send([], [], function ($message) use (&$toMail, &$fromEmail, &$appName, &$errorMessage, &$title) {
                    $message->from($fromEmail, $appName)
                    ->to( $toMail )
                    ->subject( $appName . $title)
                    ->setBody($errorMessage, 'text/html');
                });
            }

        }

    }
}