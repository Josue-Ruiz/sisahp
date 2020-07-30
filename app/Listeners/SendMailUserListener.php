<?php

namespace App\Listeners;

use App\Events\SendMailUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\RecoverAccount;
use Mail;

class SendMailUserListener
{
    
    public function __construct()
    {
        //
    }

    
    public function handle(SendMailUser $event)
    {
        Mail::to($event->datos['correo'])->send(new RecoverAccount($event->datos));
    }
}
