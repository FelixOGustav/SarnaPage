<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MassMail;
use Session;

class MailController extends Controller
{
    function SendMail($addresses, $mailid){
        $mail = \App\mail::find($mailid);
        $amount = count($addresses);
        for($x = 0; $x < $amount; $x++){
            \Mail::to($addresses[$x])->send(new MassMail($mail));

            // Update values for progress bar
            $i = ($x / $amount) * 100;
            Session::put('progress', $i);
            Session::save();
        }
    }

    public function Progress(){
        return response()->json(array(Session::get('progress')));
    }

    // Return admin page mail view
    public function Mail(){
        $mails = \App\mail::all();
        return view('AdminPages/mail', ['mails' => $mails]);
    }

    public function UpdateServe($id){
        $mail = \App\mail::find($id);
        return view('AdminPages/updatemail', ['mail' => $mail]);
    }

    // Stores a new email
    public function Store(){
        $mail = new \App\mail();

        $mail->subject = Request('subject');
        $mail->body = Request('body');

        $mail->save();
        
        return redirect('/admin/mail');
    }

    // Updates an email
    public function Update($id){
        $mail = \App\mail::find($id);

        $mail->subject = Request('subject');
        $mail->body = Request('body');

        $mail->save();
        
        return redirect('/admin/mail');
    }

    public function Send(){
        // Initalize progress bar
        Session::put('progress', 0);
        Session::save();

        $id = Request('id');
        $addresses = [];

        if(Request('participant')){
            $localAddresses = \App\registration::all();
            foreach($localAddresses as $localAddress){
                $addresses[] = $localAddress->email;
            }
        }

        if(Request('participantAdvocate')){
            $localAddresses = \App\registration::all();
            foreach($localAddresses as $localAddress){
                $addresses[] = $localAddress->email_advocate;
            }
        }

        if(Request('leader')){
            $localAddresses = \App\registrations_leader::all();
            foreach($localAddresses as $localAddress){
                $addresses[] = $localAddress->email;
            }
        }

        if(Request('leaderAdvocate')){
            $localAddresses = \App\registrations_leader::all();
            foreach($localAddresses as $localAddress){
                $addresses[] = $localAddress->email_advocate;
            }
        }

        $this->SendMail($addresses, $id);

        return redirect('admin/mail');
    }

    public function Remove($id) {
        $mail = \App\mail::find($id);
        $mail->delete();

        return redirect('admin/mail');
    }
}
