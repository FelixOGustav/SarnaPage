<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\UrlGenerator;
use Carbon\Carbon;
use App\Mail\CampRegistration;
use \Illuminate\Support\Facades\URL;

class CampRegistrationController extends Controller
{
    protected $places;

    // Return view for normal registration
    public function registration(){
        // Returns a 403 forbidden access if registration is closed
        if(!\App\registration_state::find(1)->open){
            abort(403);
        }
        
        $places = \App\place::all();
        return view('Pages/registration', ['places' => $places, 'key' => null]);
    }

    // Return view for leaders registration
    public function registrationLeader(){
        // Returns a 403 forbidden access if registration is closed
        if(!\App\registration_state::find(1)->open){
            abort(403);
        }

        $places = \App\place::all();
        return view('Pages/registration-leader', ['places' => $places, 'key' => null]);
    }

    public function lateRegistration($key){
        $links = \App\late_registration_key::where('leader', '=', 0)->get();

        foreach($links as $link){
            if($key == $link->link_key){
                $places = \App\place::all();
                return view('Pages/registration', ['places' => $places, 'key' => $key]);
            }
        }

        return view('Pages/invalidaddress');
    }

    public function lateRegistrationLeader($key){
        $links = \App\late_registration_key::where('leader', '=', 1)->get();
        foreach($links as $link){
            if($key == $link->link_key){
                $places = \App\place::all();
                return view('Pages/registration-leader', ['places' => $places, 'key' => $key]);
            }
        }

        return view('Pages/invalidaddress');
    }
    
    // Fetch registration and return view for registration done
    public function registrationDone($type, $id){
        if($type == 'participant'){
            $reg = \App\registration::find($id);
            return view('Pages/registrationdone', ['mail' => $reg->email_advocate, 'recipient' => 'Din målsman']);
        }
        else{
            $reg = \App\registrations_leader::find($id);
            return view('Pages/registrationdone', ['mail' => $reg->email, 'recipient' => 'Du']);
        }
    }

    // Fetch registration and return verified view
    public function VerificationDone($type, $id){
        if($type == 'participant'){
            $reg = \App\registration::find($id);
        }
        else{
            $reg = \App\registrations_leader::find($id);
        }
        return view('Pages/verificationdone', ['reg' => $reg]);
    }
    
    // Fetch registration and return view for edit registration
    public function EditRegistration($type, $id){
        if($type == 'participant'){
            $reg = \App\registration::find($id);
            $leader = false;
        }
        else{
            $reg = \App\registrations_leader::find($id);
            $leader = true;
        }
        return view('AdminPages/editregistration', ['reg' => $reg, 'leader' => $leader]);
    }
    
    // Standard attendee
    public function store(){
        $count = \App\registrations_leader::count() + \App\registration::count();
        if($count > 279) {
            return redirect('/registrationfull');
        }

        $registration= new \App\registration();
        //return request()->all();
        
        $registration->first_name = Request('firstName');
        $registration->last_name = Request('lastName');
        $registration->birthdate = Request('birthdate');
        $registration->last_four = Request('fourLast');
        $registration->address = Request('address');
        $registration->zip = Request('zip');
        $registration->city = Request('city');
        $registration->email = Request('email');
        $registration->phonenumber = Request('phoneNumber');
        $registration->allergy = Request('allergy');
        $registration->first_name_advocate = Request('firstNameAdvocate');
        $registration->last_name_advocate = Request('lastNameAdvocate');
        $registration->email_advocate = Request('emailAdvocate');
        $registration->phone_number_advocate = Request('phoneNumberAdvocate');
        $registration->home_number = Request('homeNumberAdvocate');
        $registration->place = Request('place');
        $registration->member_place = Request('memberPlace');
        $registration->other = Request('other');
        $registration->terms = Request('terms');

        $registrations = \App\registration::all();
        foreach($registrations as $otherReg){
            if($registration->birthdate == $otherReg->birthdate && $registration->last_four == $otherReg->last_four){
                return redirect('/registrationExists');
            }
        }

        if(Request('memberPlace')==0){
            $registration->member = 0;
            $registration->member_place =null;
        }

        else{
            $registration->member = 1;
        }

        
        //$registration->verification_key = Hash::make($registration->first_name . $registration->phonenumber);
        $registration->save();

        // Verification link generated by registration id and verification key
        $verificationLink = Url::signedRoute('event.verifyRegistration', [
            'type' => 'participant', 
            'id' => $registration->id
            ]);
        
        // Send Email
        \Mail::to($registration->email_advocate)->send(new CampRegistration($registration, $verificationLink));

        return redirect('/registration/done/participant/' . $registration->id);
    }

    // leader attendee
    public function storeLeader(){
        $count = \App\registrations_leader::count() + \App\registration::count();
        if($count > 279) {
            return redirect('/registrationfull');
        }

        
        $registration = new \App\registrations_leader();
        //return request()->all();
        
        $registration->first_name = Request('firstName');
        $registration->last_name = Request('lastName');
        $registration->birthdate = Request('birthdate');
        $registration->last_four = Request('fourLast');
        $registration->address = Request('address');
        $registration->zip = Request('zip');
        $registration->city = Request('city');
        $registration->email = Request('email');
        $registration->phonenumber = Request('phoneNumber');
        $registration->allergy = Request('allergy');
        $registration->first_name_advocate = Request('firstNameAdvocate');
        $registration->last_name_advocate = Request('lastNameAdvocate');
        $registration->email_advocate = Request('emailAdvocate');
        $registration->phone_number_advocate = Request('phoneNumberAdvocate');
        $registration->home_number = Request('homeNumberAdvocate');
        $registration->place = Request('place');
        $registration->member_place = Request('memberPlace');
        $registration->other = Request('other');
        $registration->terms = Request('terms');
        $registration->kitchen = Request('kitchen');

        $registrations = \App\registrations_leader::all();
        foreach($registrations as $otherReg){
            if($registration->birthdate == $otherReg->birthdate && $registration->last_four == $otherReg->last_four){
                return redirect('/registrationExists');
            }
        }

        if(Request('kitchen') > 0){
            $registration->cost = 1000;
        }
        else{
            $registration->cost = 1500;
        }

        if(Request('memberPlace')==0){
            $registration->member = 0;
            $registration->member_place =null;
        }

        else{
            $registration->member = 1;
        }

        
        //$registration->verification_key = Hash::make($registration->first_name . $registration->phonenumber);
        $registration->save();

        // Verification link generated by registration id and verification key
        $verificationLink = Url::signedRoute('event.verifyRegistration', [
            'type' => 'leader', 
            'id' => $registration->id
            ]);
        
        // Send Email
        \Mail::to($registration->email)->send(new CampRegistration($registration, $verificationLink));

        return redirect('/registration/done/leader/' . $registration->id);
    }

    // Standard attendee late registration
    public function LateStore($key){
        
        // If there is no key valid or type is wrong the registration will be discarded and will redirect to invalid address
        $linkEntry = \App\late_registration_key::where('link_key', '=', $key)->first();
        if($linkEntry == null || $linkEntry->leader != 0) {
            return redirect('/invalidaddress');
        }

        $registration= new \App\registration();
        //return request()->all();
        
        $registration->first_name = Request('firstName');
        $registration->last_name = Request('lastName');
        $registration->birthdate = Request('birthdate');
        $registration->last_four = Request('fourLast');
        $registration->address = Request('address');
        $registration->zip = Request('zip');
        $registration->city = Request('city');
        $registration->email = Request('email');
        $registration->phonenumber = Request('phoneNumber');
        $registration->allergy = Request('allergy');
        $registration->first_name_advocate = Request('firstNameAdvocate');
        $registration->last_name_advocate = Request('lastNameAdvocate');
        $registration->email_advocate = Request('emailAdvocate');
        $registration->phone_number_advocate = Request('phoneNumberAdvocate');
        $registration->home_number = Request('homeNumberAdvocate');
        $registration->place = Request('place');
        $registration->member_place = Request('memberPlace');
        $registration->other = Request('other');
        $registration->terms = Request('terms');

        $registrations = \App\registration::all();
        foreach($registrations as $otherReg){
            if($registration->birthdate == $otherReg->birthdate && $registration->last_four == $otherReg->last_four){
                return redirect('/registrationExists');
            }
        }

        if(Request('memberPlace')==0){
            $registration->member = 0;
            $registration->member_place =null;
        }

        else{
            $registration->member = 1;
        }

        
        //$registration->verification_key = Hash::make($registration->first_name . $registration->phonenumber);
        $registration->save();

        // Verification link generated by registration id and verification key
        $verificationLink = Url::signedRoute('event.verifyRegistration', [
            'type' => 'participant', 
            'id' => $registration->id
            ]);
        
        // Send Email
        \Mail::to($registration->email_advocate)->send(new CampRegistration($registration, $verificationLink));

        // Removes key from table so it cant be used again
        $linkEntry->delete();

        return redirect('/registration/done/participant/' . $registration->id);
    }

    // leader attendee late registration
    public function LateStoreLeader($key){

        // If there is no key valid or type is wrong the registration will be discarded and will redirect to invalid address
        $linkEntry = \App\late_registration_key::where('link_key', '=', $key)->first();
        if($linkEntry == null || $linkEntry->leader == 0) {
            return redirect('/invalidaddress');
        }
        
        $registration = new \App\registrations_leader();
        //return request()->all();
        
        $registration->first_name = Request('firstName');
        $registration->last_name = Request('lastName');
        $registration->birthdate = Request('birthdate');
        $registration->last_four = Request('fourLast');
        $registration->address = Request('address');
        $registration->zip = Request('zip');
        $registration->city = Request('city');
        $registration->email = Request('email');
        $registration->phonenumber = Request('phoneNumber');
        $registration->allergy = Request('allergy');
        $registration->first_name_advocate = Request('firstNameAdvocate');
        $registration->last_name_advocate = Request('lastNameAdvocate');
        $registration->email_advocate = Request('emailAdvocate');
        $registration->phone_number_advocate = Request('phoneNumberAdvocate');
        $registration->home_number = Request('homeNumberAdvocate');
        $registration->place = Request('place');
        $registration->member_place = Request('memberPlace');
        $registration->other = Request('other');
        $registration->terms = Request('terms');
        $registration->kitchen = Request('kitchen');

        $registrations = \App\registrations_leader::all();
        foreach($registrations as $otherReg){
            if($registration->birthdate == $otherReg->birthdate && $registration->last_four == $otherReg->last_four){
                return redirect('/registrationExists');
            }
        }

        if(Request('kitchen') > 0){
            $registration->cost = 1000;
        }
        else{
            $registration->cost = 1500;
        }

        if(Request('memberPlace')==0){
            $registration->member = 0;
            $registration->member_place =null;
        }

        else{
            $registration->member = 1;
        }

        
        //$registration->verification_key = Hash::make($registration->first_name . $registration->phonenumber);
        $registration->save();

        // Verification link generated by registration id and verification key
        $verificationLink = Url::signedRoute('event.verifyRegistration', [
            'type' => 'leader', 
            'id' => $registration->id
            ]);
        
        // Send Email
        \Mail::to($registration->email)->send(new CampRegistration($registration, $verificationLink));

        // Removes key from table so it cant be used again
        $linkEntry->delete();

        return redirect('/registration/done/leader/' . $registration->id);
    }


    // Fetch old registration and update the new data
    public function StoreEdit($type, $id){
        
        // Fetch registration from database
        if($type == 'participant'){
            $registration = \App\registration::find($id);
            $leader = false;
        }
        else{
            $registration = \App\registrations_leader::find($id);
            $leader = true;
        }

        // Update data
        $registration->first_name = Request('firstName');
        $registration->last_name = Request('lastName');
        $registration->email = Request('email');
        $registration->email_advocate = Request('emailAdvocate');
        // Add more column changes here when adding them to the view

        // Save new data to database
        $registration->save();
        return redirect('/admin/registrationlists/'.$type);
    }

    
    // Verifys registration and redirects to verified done page
    public function VerifyRegistration($type, $id){
        if($type == 'participant'){
            $fetchedRegistration = \App\registration::find($id);
            if($fetchedRegistration != null){
                $fetchedRegistration->verified_at = Carbon::now()->toDateTimeString();
                $fetchedRegistration->save();
            }
            return redirect('/registration/verify/done/participant/' . $fetchedRegistration->id);
        }
        elseif($type == 'leader'){
            $fetchedRegistration = \App\registrations_leader::find($id);
            if($fetchedRegistration != null){
                $fetchedRegistration->verified_at = Carbon::now()->toDateTimeString();
                $fetchedRegistration->save();
            }
            return redirect('/registration/verify/done/leader/' . $fetchedRegistration->id);
        }
        else{
            return 'Något gick fel. Kontakta lägerledningen eller webansvariga';
        }
    }

    // Resends verification email
    public function ResendVerificationEmail($type, $id){
        if($type == 'participant'){
            $reg = \App\registration::find($id);
            if($reg->verified_at == null){
                $verificationLink = Url::signedRoute('event.verifyRegistration', [
                    'type' => 'participant', 
                    'id' => $reg->id
                    ]);
                
                // Send Email
                \Mail::to($reg->email_advocate)->send(new CampRegistration($reg, $verificationLink));
            }      
        }
        else{
            $reg = \App\registrations_leader::find($id);
            if($reg->verified_at == null){
                $verificationLink = Url::signedRoute('event.verifyRegistration', [
                    'type' => 'leader', 
                    'id' => $reg->id
                    ]);
                
                // Send Email
                \Mail::to($reg->email)->send(new CampRegistration($reg, $verificationLink));
            }            
        }
        return redirect('admin/registrationlists/'.$type);
    }

    // Signup for late registration list
    public function Lateregistrationsignup(){

        $mailable = Request('name') .' :: ' .Request('email');
        \Mail::raw($mailable, function ($message) {
            $message->from(Request('email'), Request('name'));
            $message->to('latereglist@branaslagret.se', 'Sen anmälan');
            $message->subject('Sen Anmälan för '.Request('name'));
        });

        return redirect('/');
    }

    private function SpotFree(){
        $count = Registrations_leader::count() + Registration::count();
        if($count < 281) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function GetAgeFromDate($date) {
        return Carbon::parse($date)->age;
    }

    public static function GetGenderFromLastFour($lastfour) {
        $num = intval(substr($lastfour, 2, 1)) % 2;

        if($num == 1){
            return 'Kille';
        }
        else {
            return 'Tjej';
        }
    }
}
