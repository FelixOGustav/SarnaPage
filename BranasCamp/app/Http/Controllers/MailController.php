<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 180); //3 minutes

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\MassMail;
use App\Jobs\SendMassEmailJob;
use Session;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    function SendMail($addresses, $mailid){
        $counter = 0;
        $mail = \App\mail::find($mailid);
        foreach($addresses as $address){
            //dispatch(new SendMassEmailJob($address, $mailid));  // Puts mails in queue and will be sent one per minute (currently setup with a cronjob "php artisan queue:work --once")
            \Mail::to($address)->send(new MassMail($mail));
            $counter++;
            $i = ($counter / count($addresses)) * 100;
            Session::put('progress', $i);
            Session::save();
        }
    }

    public function Progress(){
        return response()->json(array(Session::get('progress')));
        //return response()->json(array(\App\job::count()));
    }

    // Return admin page mail view
    public function Mail(){
        $mails = \App\mail::all();
        $leaders = \App\registrations_leader::count();
        $registrations = \App\registration::count();
        //$queued = \App\job::count();
        return view('AdminPages/mail', ['mails' => $mails]); //, 'queued' => $queued]);
    }

    public function UpdateServe($id){
        $mail = \App\mail::find($id);
        return view('AdminPages/updatemail', ['mail' => $mail]);
    }

    // Stores a new email
    public function Store(Request $request){
        $this->validate($request, [
            'attachment' => 'mimetypes:application/pdf|nullable|max:1999'
        ]);

        $mail = new \App\mail();
        
        // Handle file attachment upload
        if($request->hasFile('attachment')){
            // Get filename and set it to a uniqe name
            $fileNameWithExt = $request->file('attachment')->getClientOriginalName(); // Check what to use for pdf
            $fileNameWithoutExt = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('attachment')->getClientOriginalExtension();
            $fileNameToStore = $fileNameWithoutExt.'_'.time().'.'.$extension;

            // Upload
            $path = $request->file('attachment')->storeAs('mailAttachments', $fileNameToStore);
            $mail->attachment = $fileNameToStore;
            $mail->attachment_send_name = $fileNameWithExt;
        } 

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

        $address = [];

        if(Request('participant')){
            $localAddresses = \App\registration::all();
            foreach($localAddresses as $localAddress){
                $address[] = $localAddress->email;
            }
        }

        if(Request('participantAdvocate')){
            $localAddresses = \App\registration::all();
            foreach($localAddresses as $localAddress){
                $address[] = $localAddress->email_advocate;
            }
        }

        if(Request('leader')){
            $localAddresses = \App\registrations_leader::all();
            foreach($localAddresses as $localAddress){
                $address[] = $localAddress->email;
            }
        }

        if(Request('leaderAdvocate')){
            $localAddresses = \App\registrations_leader::all();
            foreach($localAddresses as $localAddress){
                $address[] = $localAddress->email_advocate;
            }
        }

        if(Request('email')){
            $address[] = Request('email');
        }

        $this->SendMail($address, $id);

        return redirect('admin/mail');
    }

    public function Duplicate($id) {
        $mail = \App\mail::find($id);
        $newMail = new \App\mail();

        $newMail->subject = $mail->subject;
        $newMail->body = $mail->body;
        if($mail->attachment != null){
            $newMail->attachment = $mail->attachment;
        }
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
        Storage::delete('mailAttachments/'.$mail->attachment);
        $mail->delete();
        return redirect('admin/mail');
    }
}
