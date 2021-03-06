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
        $camp = \App\camp::where('active', 1)->first();
        // Returns a 403 forbidden access if registration is closed
        if(!$camp->open){
            abort(403);
        }

        $takenMap = array();
        $places = \App\place::where('camp_id', $camp->id)->orderBy('placename', 'ASC')->get();
        foreach($places as $place){
            $takenMap[$place->placeID] = !$this->isSpotsAvailable($camp, $place, false);
        }

        return view('Pages/registration', ['places' => $places, 'key' => null, 'takenMap' => $takenMap]);
    }

    // Return view for leaders registration
    public function registrationLeader(){
        $camp = \App\camp::where('active', 1)->first();
        // Returns a 403 forbidden access if registration is closed
        if(!$camp->open){
            abort(403);
        }

        $takenMap = array();
        $places = \App\place::where('camp_id', $camp->id)->orderBy('placename', 'ASC')->get();
        foreach($places as $place){
            $takenMap[$place->placeID] = !$this->isSpotsAvailable($camp, $place, false);
        }

        return view('Pages/registration-leader', ['places' => $places, 'key' => null, 'takenMap' => $takenMap]);
    }

    public function lateRegistration($key){
        $camp = \App\camp::where('active', 1)->first();
        $links = \App\late_registration_key::where('leader', '=', 0)->get();

        foreach($links as $link){
            if($key == $link->link_key){
                $takenMap = array();
                $places = \App\place::where('camp_id', $camp->id)->orderBy('placename', 'ASC')->get();
                foreach($places as $place){
                    $takenMap[$place->placeID] = false;
                }
                return view('Pages/registration', ['places' => $places, 'key' => $key, 'takenMap' => $takenMap]);
            }
        }

        return view('Pages/invalidaddress');
    }

    public function lateRegistrationLeader($key){
        $camp = \App\camp::where('active', 1)->first();
        $links = \App\late_registration_key::where('leader', '=', 1)->get();
        
        foreach($links as $link){
            if($key == $link->link_key){
                $takenMap = array();
                $places = \App\place::where('camp_id', $camp->id)->orderBy('placename', 'ASC')->get();
                foreach($places as $place){
                    $takenMap[$place->placeID] = false;
                }
                return view('Pages/registration-leader', ['places' => $places, 'key' => $key, 'takenMap' => $takenMap]);
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
        $places = \App\place::orderBy('placename', 'ASC')->get();
        return view('AdminPages/editregistration', ['reg' => $reg, 'leader' => $leader, 'places' => $places]);
    }
    
    // Standard attendee
    public function store(Request $request){
        $camp = \App\camp::where('active', 1)->first();
        $count = \App\registration::count();
        /* if($count >= $camp->participantSpots) {
            return redirect('/registrationfull');
        } */
        // Validation of request
        $validation = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'socialSecurityNumber' => 'required|alpha_num|size:10',
            'email' => 'email:rfc,dns',
            'emailAdvocate' => 'email:rfc,dns',
            'place' => [function ($attribute, $value, $fail) {
                $place = \App\place::find((int)$value);
                $campForValidation = \App\camp::where('active', 1)->first();
                if($place->camp_id != $campForValidation->id){
                    $fail("Den ort du valt ingår ej i lägret. Försök igen eller välj en annan ort");
                }
                if (!$this->isSpotsAvailable($campForValidation, $place, false)) {
                    $prefix = '[' . Carbon::now() . '] | [ Registration ] | ';
                    $newLine = "\n";
                    $logFilePath = 'logs/registrationLog.log';
                    $leadersCount = \App\registrations_leader::all()
                        ->where('place', $place->placeID)
                        ->where('camp_id', $camp->id)
                        ->count();
                    $participantsCount = \App\registration::all()
                        ->where('place', $place->placeID)
                        ->where('camp_id', $camp->id)
                        ->count();
                    file_put_contents(storage_path($logFilePath), $prefix . 'Spots full in: ' . $place->placename . $newLine, FILE_APPEND);
                    file_put_contents(storage_path($logFilePath), $prefix . 'Registrations: ' . $participantsCount . $newLine, FILE_APPEND);
                    file_put_contents(storage_path($logFilePath), $prefix . 'Leaders: ' . $leadersCount . $newLine, FILE_APPEND);
                    $fail('Plattserna i den ort du valt är tyvärr slut. Välj en annan ort om du vågar');
                }
            }]
        ]);

        $registration= new \App\registration();
        //return request()->all();
        
        // parse birthdate and last four from personnummer
        $ssn = Request('socialSecurityNumber');
        $ssn = preg_replace('/[^0-9]/', '', $ssn);
        $year = substr($ssn, 0, 2);
        $month = substr($ssn, 2, 2);
        $day = substr($ssn, 4, 2);
        $lastfour = substr($ssn, 6, 4);

        // Add correct century, since it originaly doesn't contain it
        if((int)$year > 40){
            $year = "19" . $year;
        }
        else {
            $year = "20" . $year;
        }

        // Build the birthday string
        $birthday = $year . "-" . $month . "-" . $day;
        
         // parse birthdate and last four from personnummer
         $ssnAdvocate = Request('socialSecurityNumberAdvocate');
         $ssnAdvocate = preg_replace('/[^0-9]/', '', $ssnAdvocate);
         $yearAdvocate = substr($ssnAdvocate, 0, 2);
         $monthAdvocate = substr($ssnAdvocate, 2, 2);
         $dayAdvocate = substr($ssnAdvocate, 4, 2);
         $lastfourAdvocate = substr($ssnAdvocate, 6, 4);
 
         // Add correct century, since it originaly doesn't contain it
         if((int)$yearAdvocate > 40){
             $yearAdvocate = "19" . $yearAdvocate;
         }
         else {
             $yearAdvocate = "20" . $yearAdvocate;
         }
 
         // Build the birthday string
         $birthdayAdvocate = $yearAdvocate . "-" . $monthAdvocate . "-" . $dayAdvocate;
 
        $registration->first_name = Request('firstName');
        $registration->last_name = Request('lastName');
        $registration->birthdate = $birthday;
        $registration->last_four = $lastfour;
        $registration->address = Request('address');
        $registration->zip = Request('zip');
        $registration->city = Request('city');
        $registration->email = Request('email');
        $registration->phonenumber = Request('phoneNumber');
        $registration->allergy = Request('allergy');
        $registration->first_name_advocate = Request('firstNameAdvocate');
        $registration->last_name_advocate = Request('lastNameAdvocate');
        $registration->birthdate_advocate = $birthdayAdvocate;
        $registration->last_four_advocate = $lastfourAdvocate;
        $registration->email_advocate = Request('emailAdvocate');
        $registration->phone_number_advocate = Request('phoneNumberAdvocate');
        $registration->home_number = Request('homeNumberAdvocate');
        $registration->place = Request('place');
        $registration->member_place = Request('memberPlace');
        $registration->other = Request('other');
        $registration->terms = Request('terms');
        $registration->camp_id = $camp->id;
        /*if(Request('discount')){
            $registration->discount = Request('discount');
        }
        else {
            $registration->discount = '0';
        }
        */

        $registrations = \App\registration::where('camp_id', $camp->id)->get();
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

        $this->checkAndCloseRegistrationIfFull($camp);

        return redirect('/registration/done/participant/' . $registration->id);
    }

    // leader attendee
    public function storeLeader(Request $request){
        $camp = \App\camp::where('active', 1)->first();
        $count = \App\registrations_leader::count();
        /* if($count >= $camp->leaderSpots) {
            return redirect('/registrationfull');
        } */
        // Validation of request
        $validation = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'socialSecurityNumber' => 'required|alpha_num|size:10',
            'email' => 'email:rfc,dns',
            'emailAdvocate' => 'email:rfc,dns',
            'place' => [function ($attribute, $value, $fail) {
                $place = \App\place::find((int)$value);
                $campForValidation = \App\camp::where('active', 1)->first();
                $prefix = '[' . Carbon::now() . '] | [ Registration ] | ';
                $newLine = "\n";
                $logFilePath = 'logs/registrationLog.log';
                if($place->camp_id != $campForValidation->id){
                    file_put_contents(storage_path($logFilePath), $prefix . 'Invalid place: ' . $place->placename . ":". $place->placeID . " Place camp id: " . $place->camp_id. " active camp id: " . $campForValidation->id . $newLine, FILE_APPEND);
                    $fail("Den ort du valt ingår ej i lägret. Försök igen eller välj en annan ort");
                }
                if (!$this->isSpotsAvailable($campForValidation, $place, true)) {
                    $leadersCount = \App\registrations_leader::all()
                        ->where('place', $place->placeID)
                        ->where('camp_id', $camp->id)
                        ->count();
                    $participantsCount = \App\registration::all()
                        ->where('place', $place->placeID)
                        ->where('camp_id', $camp->id)
                        ->count();
                    file_put_contents(storage_path($logFilePath), $prefix . 'Spots full in: ' . $place->placename . $newLine, FILE_APPEND);
                    file_put_contents(storage_path($logFilePath), $prefix . 'Registrations: ' . $participantsCount . $newLine, FILE_APPEND);
                    file_put_contents(storage_path($logFilePath), $prefix . 'Leaders: ' . $leadersCount . $newLine, FILE_APPEND);
                    $fail('Plattserna i den ort du valt är tyvärr slut. Välj en annan ort om du vågar');
                }
            }]
        ]);
        
        
        $registration = new \App\registrations_leader();
        //return request()->all();

        // parse birthdate and last four from personnummer
        $ssn = Request('socialSecurityNumber');
        $ssn = preg_replace('/[^0-9]/', '', $ssn);
        $year = substr($ssn, 0, 2);
        $month = substr($ssn, 2, 2);
        $day = substr($ssn, 4, 2);
        $lastfour = substr($ssn, 6, 4);

        // Add correct century, since it originaly doesn't contain it
        if((int)$year > 40){
            $year = "19" . $year;
        }
        else {
            $year = "20" . $year;
        }

        // Build the birthday string
        $birthday = $year . "-" . $month . "-" . $day;
        
        $registration->first_name = Request('firstName');
        $registration->last_name = Request('lastName');
        $registration->birthdate = $birthday;
        $registration->last_four = $lastfour;
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
        $registration->camp_id = $camp->id;
        /*if(Request('discount')){
            $registration->discount = Request('discount');
        }
        else {
            $registration->discount = '0';
        }*/
        $registration->kitchen = Request('kitchen');
        
        $registrations = \App\registrations_leader::where('camp_id', $camp->id)->get();
        foreach($registrations as $otherReg){
            if($registration->birthdate == $otherReg->birthdate && $registration->last_four == $otherReg->last_four){
                return redirect('/registrationExists');
            }
        }

        if(Request('kitchen') > 0){
            $registration->cost = 600;
        }
        else{
            $registration->cost = 600;
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

        $this->checkAndCloseRegistrationIfFull($camp);

        return redirect('/registration/done/leader/' . $registration->id);
    }

    // Standard attendee late registration
    public function LateStore($key){        
        $camp = \App\camp::where('active', 1)->first();
        
        // If there is no key valid or type is wrong the registration will be discarded and will redirect to invalid address
        $linkEntry = \App\late_registration_key::where('link_key', '=', $key)->first();
        if($linkEntry == null || $linkEntry->leader != 0) {
            return redirect('/invalidaddress');
        }

        $registration= new \App\registration();
        //return request()->all();

        // parse birthdate and last four from personnummer
        $ssn = Request('socialSecurityNumber');
        $ssn = preg_replace('/[^0-9]/', '', $ssn);
        $year = substr($ssn, 0, 2);
        $month = substr($ssn, 2, 2);
        $day = substr($ssn, 4, 2);
        $lastfour = substr($ssn, 6, 4);

        // Add correct century, since it originaly doesn't contain it
        if((int)$year > 40){
            $year = "19" . $year;
        }
        else {
            $year = "20" . $year;
        }

        // Build the birthday string
        $birthday = $year . "-" . $month . "-" . $day;

        // parse birthdate and last four from personnummer
        $ssnAdvocate = Request('socialSecurityNumberAdvocate');
        $ssnAdvocate = preg_replace('/[^0-9]/', '', $ssnAdvocate);
        $yearAdvocate = substr($ssnAdvocate, 0, 2);
        $monthAdvocate = substr($ssnAdvocate, 2, 2);
        $dayAdvocate = substr($ssnAdvocate, 4, 2);
        $lastfourAdvocate = substr($ssnAdvocate, 6, 4);

        // Add correct century, since it originaly doesn't contain it
        if((int)$yearAdvocate > 40){
            $yearAdvocate = "19" . $yearAdvocate;
        }
        else {
            $yearAdvocate = "20" . $yearAdvocate;
        }

        // Build the birthday string
        $birthdayAdvocate = $yearAdvocate . "-" . $monthAdvocate . "-" . $dayAdvocate;
        
        $registration->first_name = Request('firstName');
        $registration->last_name = Request('lastName');
        $registration->birthdate = $birthday;
        $registration->last_four = $lastfour;
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
        $registration->birthdate_advocate = $birthdayAdvocate;
        $registration->last_four_advocate = $lastfourAdvocate;
        $registration->home_number = Request('homeNumberAdvocate');
        $registration->place = Request('place');
        $registration->member_place = Request('memberPlace');
        $registration->other = Request('other');
        $registration->terms = Request('terms');
        $registration->camp_id = $camp->id;
        /*if(Request('discount')){
            $registration->discount = Request('discount');
        }
        else {
            $registration->discount = '0';
        }
*/
        $registrations = \App\registration::where('camp_id', $camp->id)->get();
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

        $registrations = \App\registration::where('camp_id', '=', $camp->id)->get();
        foreach($registrations as $otherReg){
            if($registration->birthdate == $otherReg->birthdate && $registration->last_four == $otherReg->last_four){$prefix = '[' . Carbon::now() . '] | [ Registration ] | ';
                $newLine = "\n";
                $logFilePath = 'logs/registrationLog.log';
                file_put_contents(storage_path($logFilePath), $prefix . 'Registration with same SSN found' . $newLine, FILE_APPEND);
                file_put_contents(storage_path($logFilePath), $prefix . 'SSN: ' . $birthday . '-' . $lastfour . $newLine, FILE_APPEND);
                file_put_contents(storage_path($logFilePath), $prefix . 'Registration id of match: ' . $otherReg->id . $newLine, FILE_APPEND);
                
                $diff = $otherReg->created_at->diffInSeconds();
                if($diff > 2){
                    return redirect('/registrationExists');
                } else {
                    file_put_contents(storage_path($logFilePath), $prefix . 'Difference in time: ' . $diff . $newLine, FILE_APPEND);
                    file_put_contents(storage_path($logFilePath), $prefix . 'Acting like registration happened like normal' . $newLine, FILE_APPEND);
                    return redirect('/registration/done/participant/' . $otherReg->id);
                }
            }
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

        // If the link is connected to one in the queue, remove that queue entry
        $registrationQueue = \App\registrationqueue::where('linkId', $linkEntry->id)->first();
        if($registrationQueue != null){
            $registrationQueue->delete();
        }

        // Removes key from table so it cant be used again
        $linkEntry->delete();

        return redirect('/registration/done/participant/' . $registration->id);
    }

    // leader attendee late registration
    public function LateStoreLeader($key){
        $camp = \App\camp::where('active', 1)->first();

        // If there is no key valid or type is wrong the registration will be discarded and will redirect to invalid address
        $linkEntry = \App\late_registration_key::where('link_key', '=', $key)->first();
        if($linkEntry == null || $linkEntry->leader == 0) {
            return redirect('/invalidaddress');
        }
        
        $registration = new \App\registrations_leader();
        //return request()->all();

        // parse birthdate and last four from personnummer
        $ssn = Request('socialSecurityNumber');
        $ssn = preg_replace('/[^0-9]/', '', $ssn);
        $year = substr($ssn, 0, 2);
        $month = substr($ssn, 2, 2);
        $day = substr($ssn, 4, 2);
        $lastfour = substr($ssn, 6, 4);

        // Add correct century, since it originaly doesn't contain it
        if((int)$year > 40){
            $year = "19" . $year;
        }
        else {
            $year = "20" . $year;
        }

        // Build the birthday string
        $birthday = $year . "-" . $month . "-" . $day;
        
        $registration->first_name = Request('firstName');
        $registration->last_name = Request('lastName');
        $registration->birthdate = $birthday;
        $registration->last_four = $lastfour;
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
        $registration->kitchen = '0';
        $registration->camp_id = $camp->id;
        /*if(Request('discount')){
            $registration->discount = Request('discount');
        }
        else {
            $registration->discount = '0';
        }
*/
        $registrations = \App\registrations_leader::where('camp_id', '=', $camp->id)->get();
        foreach($registrations as $otherReg){
            if($registration->birthdate == $otherReg->birthdate && $registration->last_four == $otherReg->last_four){$prefix = '[' . Carbon::now() . '] | [ Registration ] | ';
                $newLine = "\n";
                $logFilePath = 'logs/registrationLog.log';
                file_put_contents(storage_path($logFilePath), $prefix . 'Registration with same SSN found' . $newLine, FILE_APPEND);
                file_put_contents(storage_path($logFilePath), $prefix . 'SSN: ' . $birthday . '-' . $lastfour . $newLine, FILE_APPEND);
                file_put_contents(storage_path($logFilePath), $prefix . 'Registration id of match: ' . $otherReg->id . $newLine, FILE_APPEND);
                
                $diff = $otherReg->created_at->diffInSeconds();
                if($diff > 2){
                    return redirect('/registrationExists');
                } else {
                    file_put_contents(storage_path($logFilePath), $prefix . 'Difference in time: ' . $diff . $newLine, FILE_APPEND);
                    file_put_contents(storage_path($logFilePath), $prefix . 'Acting like registration happened like normal' . $newLine, FILE_APPEND);
                    return redirect('/registration/done/leader/' . $otherReg->id);
                }
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

        // If the link is connected to one in the queue, remove that queue entry
        $registrationQueue = \App\registrationqueue::where('linkId', $linkEntry->id)->first();
        if($registrationQueue != null){
            $registrationQueue->delete();
        }

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
            $registration->kitchen = Request('kitchen') != null ? Request('kitchen') : $registration->kitchen;
            $leader = true;
        }

        // Update data
        $registration->first_name = Request('firstName');
        $registration->last_name = Request('lastName');
        $registration->email = Request('email');
        $registration->email_advocate = Request('emailAdvocate');
        $registration->place = Request('place') != null ? Request('place') : $registration->place;
        $registration->address = Request('address');
        $registration->zip = Request('zip');
        $registration->city = Request('city');
        $registration->phonenumber = Request('phoneNumber');
        $registration->phone_number_advocate = Request('phoneNumberAdvocate');
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

    private function SpotFree(){
        $count = Registrations_leader::count() + Registration::count();
        if($count < 281) {
            return true;
        }
        else {
            return false;
        }
    }

    public function MoveRegistrationToCancelled($type, $id){
        if($type == "participant"){
            $registration = \App\registration::find($id);     
            $cancelled_registration = new \App\registrations_cancel();       
        }
        else {
            $registration = \App\registrations_leader::find($id);
            $cancelled_registration = new \App\registrations_leaders_cancel();
        }
        
        // Copy all columns
        $cancelled_registration->first_name =$registration->first_name;
        $cancelled_registration->last_name = $registration->last_name;
        $cancelled_registration->birthdate = $registration->birthdate;
        $cancelled_registration->last_four = $registration->last_four;
        $cancelled_registration->address = $registration->address ;
        $cancelled_registration->zip = $registration->zip;
        $cancelled_registration->city = $registration->city;
        $cancelled_registration->email = $registration->email;
        $cancelled_registration->phonenumber = $registration->phonenumber;
        $cancelled_registration->allergy = $registration->allergy;
        $cancelled_registration->first_name_advocate =$registration->first_name_advocate;
        $cancelled_registration->last_name_advocate = $registration->last_name_advocate;
        if($type == "participant") {
            $cancelled_registration->birthdate_advocate = $registration->birthdate_advocate;
            $cancelled_registration->last_four_advocate = $registration->last_four_advocate;
        }
        $cancelled_registration->email_advocate = $registration->email_advocate;
        $cancelled_registration->verified_at = $registration->verified_at;
        $cancelled_registration->phone_number_advocate = $registration->phone_number_advocate;
        $cancelled_registration->home_number = $registration->home_number;
        $cancelled_registration->place = $registration->place;
        $cancelled_registration->member = $registration->member;
        $cancelled_registration->member_place = $registration->member_place;
        $cancelled_registration->cost = $registration->cost;
        $cancelled_registration->other = $registration->other;
        $cancelled_registration->terms = $registration->terms;
        $cancelled_registration->verification_key = $registration->verification_key;
        $cancelled_registration->camp_id = $registration->camp_id;
        if($type != "participant")
            $cancelled_registration->kitchen = $registration->kitchen;


        $cancelled_registration->save();  
        $registration->delete();

        if($type == "participant")
            return redirect('/admin/registrationlists/participant');
        else 
            return redirect('/admin/registrationlists/leader');
    }

    public function RestoreCancelledRegistration($type, $id){
        if($type == "participant"){
            $cancelled_registration = \App\registrations_cancel::find($id);     
            $registration = new \App\registration();       
        }
        else {
            $cancelled_registration = \App\registrations_leaders_cancel::find($id);
            $registration = new \App\registrations_leader();
        }
        
        // Copy all columns
        $registration->first_name =$cancelled_registration->first_name;
        $registration->last_name = $cancelled_registration->last_name;
        $registration->birthdate = $cancelled_registration->birthdate;
        $registration->last_four = $cancelled_registration->last_four;
        $registration->address = $cancelled_registration->address ;
        $registration->zip = $cancelled_registration->zip;
        $registration->city = $cancelled_registration->city;
        $registration->email = $cancelled_registration->email;
        $registration->phonenumber = $cancelled_registration->phonenumber;
        $registration->allergy = $cancelled_registration->allergy;
        $registration->first_name_advocate =$cancelled_registration->first_name_advocate;
        $registration->last_name_advocate = $cancelled_registration->last_name_advocate;
        if($type == "participant") {
            $registration->birthdate_advocate = $cancelled_registration->birthdate_advocate;
            $registration->last_four_advocate = $cancelled_registration->last_four_advocate;
        }
        $registration->email_advocate = $cancelled_registration->email_advocate;
        $registration->verified_at = $cancelled_registration->verified_at;
        $registration->phone_number_advocate = $cancelled_registration->phone_number_advocate;
        $registration->home_number = $cancelled_registration->home_number;
        $registration->place = $cancelled_registration->place;
        $registration->member = $cancelled_registration->member;
        $registration->member_place = $cancelled_registration->member_place;
        $registration->cost = $cancelled_registration->cost;
        $registration->other = $cancelled_registration->other;
        $registration->terms = $cancelled_registration->terms;
        $registration->verification_key = $cancelled_registration->verification_key;
        $registration->camp_id = $cancelled_registration->camp_id;
        if($type != "participant")
            $registration->kitchen = $cancelled_registration->kitchen;


        $cancelled_registration->delete();
        $registration->save();  

        if($type == "participant")
            return redirect('/admin/registrationlists/participant/cancelled');
        else 
            return redirect('/admin/registrationlists/leader/cancelled');
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
    public function isSpotsAvailable($camp, $place, $leader){
        $leadersCount = \App\registrations_leader::all()
                ->where('place', $place->placeID)
                ->where('camp_id', $camp->id)
                ->count();
        $participantsCount = \App\registration::all()
                ->where('place', $place->placeID)
                ->where('camp_id', $camp->id)
                ->count();
        
        //$leadersCount = 55;
        //$participantsCount = 66;
        
        if($leader){
            return $leadersCount < $place->leaderSpots && $leadersCount + $participantsCount < $place->spots;
        } else {            
            return $participantsCount < $place->participateSpots && $leadersCount + $participantsCount < $place->spots;
        }
    }

    public function checkAndCloseRegistrationIfFull($camp){
        $places = \App\place::all();
        foreach($places as $place){
            if($this->isSpotsAvailable($camp, $place, true) || $this->isSpotsAvailable($camp, $place, false)){
                return;
            }
        }

        // no available spots found. Closing registration
        $camp = \App\camp::where('active', 1)->first();
        $camp->open = 0;
        $camp->late_open = 1;
        $camp->save();
    }
    /*
    public static function CheckAndOpenRegistrationForActiveCamp() {
        $camp = \App\camp::where('active', 1)->first();
        if($camp->registrationOpen->gt(carbon::now())) {
            $camp->open = 1;
            $camp->save();
        }
    }
    */
}
