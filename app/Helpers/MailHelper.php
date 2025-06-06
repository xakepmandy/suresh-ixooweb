<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class MailHelper
{
    public static function sendContactMail($data)
    {
        Mail::to('jatsureshkumar47@gmail.com')->send(new ContactMail($data));
    }
}
