<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class LogSuccessfulLogin
{
    public function __construct(public Request $request) {}

    public function handle(Login $event): void
    {
        $user = $event->user;
        
        // Guardamos la hora y la IP
        $user->last_login_at = now();
        $user->last_login_ip = $this->request->ip();
        $user->save();
    }
}
