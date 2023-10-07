<?php


namespace App\Http\Traits;


use Illuminate\Support\Facades\Mail;

trait SendEmail
{
    protected function send_EmailFun($email, $text, $subject)
    {
        $contact_company = ' تحفيظ ';
        $logo = asset('images/logo.jpg');
        Mail::send([
            'html' => 'Email.email-tem'],
            ['text' => $text, 'email' => $email, 'logo' => $logo, 'title' => ' تحفيظ '],
            function ($message) use ($email, $subject, $contact_company) {
                $message->to($email, $contact_company)->from('tahfeeth@frmawy.com', $contact_company)->subject($subject);
            }
        );
        info('mail after send');
    }//end fun

}//end trait
