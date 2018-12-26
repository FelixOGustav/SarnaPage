<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\MassMail;
use Session;

class MailController extends Controller
{
    function SendMail($pAddresses, $pAdvAddresses, $lAddresses, $lAdvAddresses, $otherAddress, $mailid){
        $mail = \App\mail::find($mailid);

        $MAX_MAIL_SENDS = 90;

        $pAmount = count($pAddresses);
        $pAdvAmount = count($pAdvAddresses);
        $lAmount = count($lAddresses);
        $lAdvAmount = count($lAdvAddresses);
        $otherAmount = count($otherAddress);
        $combinedAmount = $pAmount + $pAdvAmount + $lAmount + $lAdvAmount + $otherAmount;

        $progressI = 0;

        if($otherAddress){
            \Mail::to($otherAddress)->send(new MassMail($mail));
            $progressI++;
        }
        
        $participants_sends = $mail->participants_sent_amount;
        $participants_already_mailed = json_decode($mail->participants_sent_to);
        
        // If list is null, set it to empty
        if(!$participants_already_mailed){
            $participants_already_mailed = [];
        }

        for($x = 0; $x < $pAmount; $x++){
            
            if(!in_array($pAddresses[$x], $participants_already_mailed)){  // Checks if mail addressed has already been sent to
                \Mail::to($pAddresses[$x])->send(new MassMail($mail));   // Sends mail
                $participants_already_mailed[] = $pAddresses[$x];  // Adds address to list of already sent addresses
            }
            $progressI++;

            // Update values for progress bar
            $i = ($progressI / $combinedAmount) * 100;
            Session::put('progress', $i);
            
            $participants_sends++;

            // If $MAX_MAIL_SENDS mails or more have been sent, stop sending and update send amount to right and set progress bar to 100%
            if($progressI >= $MAX_MAIL_SENDS){
                $participants_sends = $x + $mail->participants_sent_amount;
                Session::put('progress', 100);
                Session::save();
                
                $mail->participants_sent_amount = $participants_sends; 
                $mail->participants_sent_to = json_encode($participants_already_mailed);
                $mail->save();
                return;
            }            
            Session::save();
        }

        $participants_advocate_sends = $mail->participants_advocate_sent_amount;
        $participants_advocate_already_mailed = json_decode($mail->participants_advocate_sent_to);
        
        // If list is null, set it to empty
        if(!$participants_advocate_already_mailed){
            $participants_advocate_already_mailed = [];
        }

        for($x = 0; $x < $pAdvAmount; $x++){
            
            if(!in_array($pAdvAddresses[$x], $participants_advocate_already_mailed)){  // Checks if mail addressed has already been sent to
                \Mail::to($pAdvAddresses[$x])->send(new MassMail($mail));   // Sends mail
                $participants_advocate_already_mailed[] = $pAdvAddresses[$x];  // Adds address to list of already sent addresses
            }
            $progressI++;

            // Update values for progress bar
            $i = ($progressI / $combinedAmount) * 100;
            Session::put('progress', $i);
            
            $participants_advocate_sends++;

            // If $MAX_MAIL_SENDS mails or more have been sent, stop sending and update send amount to right and set progress bar to 100%
            if($progressI >= $MAX_MAIL_SENDS){
                $participants_advocate_sends = $x + $mail->participants_advocate_sent_amount;
                Session::put('progress', 100);
                Session::save();
                
                $mail->participants_advocate_sent_amount = $participants_advocate_sends; 
                $mail->participants_advocate_sent_to = json_encode($participants_advocate_already_mailed);
                $mail->save();
                return;
            }            
            Session::save();
        }

        $leader_sends = $mail->leader_sent_amount;
        $leader_already_mailed = json_decode($mail->leader_sent_to);
        
        // If list is null, set it to empty
        if(!$leader_already_mailed){
            $leader_already_mailed = [];
        }

        for($x = 0; $x < $lAmount; $x++){
            
            if(!in_array($lAddresses[$x], $leader_already_mailed)){  // Checks if mail addressed has already been sent to
                \Mail::to($lAddresses[$x])->send(new MassMail($mail));   // Sends mail
                $leader_already_mailed[] = $lAddresses[$x];  // Adds address to list of already sent addresses
            }
            $progressI++;

            // Update values for progress bar
            $i = ($progressI / $combinedAmount) * 100;
            Session::put('progress', $i);
            
            $leader_sends++;

            // If $MAX_MAIL_SENDS mails or more have been sent, stop sending and update send amount to right and set progress bar to 100%
            if($progressI >= $MAX_MAIL_SENDS){
                $leader_sends = $x + $mail->leader_sent_amount;
                Session::put('progress', 100);
                Session::save();
                
                $mail->leader_sent_amount = $leader_sends; 
                $mail->leader_sent_to = json_encode($leader_already_mailed);
                $mail->save();
                return;
            }            
            Session::save();
        }

        $leader_advocate_sends = $mail->leader_advocate_sent_amount;
        $leader_advocate_already_mailed = json_decode($mail->leader_advocate_sent_to);
        
        // If list is null, set it to empty
        if(!$leader_advocate_already_mailed){
            $leader_advocate_already_mailed = [];
        }

        for($x = 0; $x < $lAdvAmount; $x++){
            
            if(!in_array($lAdvAddresses[$x], $leader_advocate_already_mailed)){  // Checks if mail addressed has already been sent to
                \Mail::to($lAdvAddresses[$x])->send(new MassMail($mail));   // Sends mail
                $leader_advocate_already_mailed[] = $lAdvAddresses[$x];  // Adds address to list of already sent addresses
            }
            $progressI++;

            // Update values for progress bar
            $i = ($progressI / $combinedAmount) * 100;
            Session::put('progress', $i);
            
            $leader_advocate_sends++;

            // If $MAX_MAIL_SENDS mails or more have been sent, stop sending and update send amount to right and set progress bar to 100%
            if($progressI >= $MAX_MAIL_SENDS){
                $sends = $x + $mail->leader_advocate_sent_amount;
                Session::put('progress', 100);
                Session::save();
                
                $mail->leader_advocate_sent_amount = $leader_advocate_sends; 
                $mail->leader_advocate_sent_to = json_encode($leader_advocate_already_mailed);
                $mail->save();
                return;
            }            
            Session::save();
        }

        if($participants_already_mailed){
            $mail->participants_sent_amount = $participants_sends; 
            $mail->participants_sent_to = json_encode($participants_already_mailed);
        }
        
        if($participants_advocate_already_mailed){
            $mail->participants_advocate_sent_amount = $participants_advocate_sends; 
            $mail->participants_advocate_sent_to = json_encode($participants_advocate_already_mailed);
        }
        if($leader_already_mailed){
            $mail->leader_sent_amount = $leader_sends; 
            $mail->leader_sent_to = json_encode($leader_already_mailed);
        }
        if($leader_advocate_already_mailed){
            $mail->leader_advocate_sent_amount = $leader_advocate_sends; 
            $mail->leader_advocate_sent_to = json_encode($leader_advocate_already_mailed);
        }

        if($progressI >= 5){
            $mail->lock_sending_until = Carbon::now()->addHour();
        }

        $mail->save();
    }

 

    public function Progress(){
        return response()->json(array(Session::get('progress')));
    }

    function CanSend(){
        $mails = \App\mail::all();
        $currentTime = Carbon::now();

        // Id
        foreach($mails as $mail){
            if($currentTime->lessThan($mail->lock_sending_until)){
                return false;
            }
        }
        return true;
    }

    // Return admin page mail view
    public function Mail(){
        $mails = \App\mail::all();
        $leaders = \App\registrations_leader::count();
        $registrations = \App\registration::count();

        return view('AdminPages/mail', ['mails' => $mails, 'leaders' => $leaders, 'registrations' => $registrations, 'cansend' => $this->CanSend()]);
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

        $participants_addresses = [];
        $participants_advocate_addresses = [];
        $leader_addresses = [];
        $leader_advocate_addresses = [];
        $otherAddress = [];

        if(Request('participant')){
            $localAddresses = \App\registration::all();
            foreach($localAddresses as $localAddress){
                $participants_addresses[] = $localAddress->email;
            }
        }

        if(Request('participantAdvocate')){
            $localAddresses = \App\registration::all();
            foreach($localAddresses as $localAddress){
                $participants_advocate_addresses[] = $localAddress->email_advocate;
            }
        }

        if(Request('leader')){
            $localAddresses = \App\registrations_leader::all();
            foreach($localAddresses as $localAddress){
                $leader_addresses[] = $localAddress->email;
            }
        }

        if(Request('leaderAdvocate')){
            $localAddresses = \App\registrations_leader::all();
            foreach($localAddresses as $localAddress){
                $leader_advocate_addresses[] = $localAddress->email_advocate;
            }
        }

        if(Request('email')){
            $otherAddress[] = Request('email');
        }

        $this->SendMail($participants_addresses, $participants_advocate_addresses, $leader_addresses, $leader_advocate_addresses, $otherAddress, $id);

        return redirect('admin/mail');
    }

    public function Duplicate($id) {
        $mail = \App\mail::find($id);
        $newMail = new \App\mail();

        $newMail->subject = $mail->subject;
        $newMail->body = $mail->body;

        $newMail->Save();

        return redirect('admin/mail');
    }

    public function ClearSendStats($id) {
        $mail = \App\mail::find($id);
        
        $mail->participants_sent_amount = 0; 
        $mail->participants_sent_to = null;
    
        $mail->participants_advocate_sent_amount = 0; 
        $mail->participants_advocate_sent_to = null;
    
        $mail->leader_sent_amount = 0; 
        $mail->leader_sent_to = null;
    
        $mail->leader_advocate_sent_amount = 0; 
        $mail->leader_advocate_sent_to = null;

        $mail->save();

        return redirect('admin/mail');
    }

    public function Remove($id) {
        $mail = \App\mail::find($id);
        $mail->delete();

        return redirect('admin/mail');
    }
}
