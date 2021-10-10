<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Model\SystemLog\LoginoutLog;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleUserLogin($event) 
    {
        $event->user->update(['login_status' => 'logged_in']);
        $event->user->increment('log_counter', 1);
        $event->user->loginoutLogs()->create([
            'action_type' => 'logged_in',
            'ip' => request()->ip(),
            'user_agent' => request()->server('HTTP_USER_AGENT')
        ]);
    }

    /* 
    "login_status" => "logged_in" 
    "log_counter" => 0 
     */
    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event) 
    {
        $event->user->update(['login_status' => 'logged_out']);
        $event->user->loginoutLogs()->create([
            'action_type' => 'logged_out',
            'ip' => request()->ip(),
            'user_agent' => request()->server('HTTP_USER_AGENT')
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
   /*  public function subscribe($events)
    {
        return [
            Login::class => 'handleUserLogin',
            Logout::class => 'handleUserLogout',
        ];
    } */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@handleUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@handleUserLogout'
        );
    }
}