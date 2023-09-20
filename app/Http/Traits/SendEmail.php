<?php


namespace App\Http\Traits;


use Illuminate\Support\Facades\Mail;

trait SendEmail
{
    protected function send_EmailFun($email,$text,$subject){
        $contact_company=' تحفيظ ';
        Mail::send([
            'html' => 'Email.email-tem'],
            ['text' => $text,'email'=>$email,'logo'=>asset('Admin/imgs/default.jpg'),'title'=>env('MAIL_FROM_NAME')],
            function($message) use ($email, $subject, $contact_company)
            {
                $message->to($email,$contact_company)->from(env('MAIL_FROM_ADDRESS'),$contact_company)->subject($subject);
            }
        );
    }//end fun

}//end trait
