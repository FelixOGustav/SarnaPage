<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\URL;
use Artisan;
use App;
use \App\Mail\LateRegistrationInvite;

class PagesController extends Controller
{
    protected $StartPagelinkslinks = [
        'navLogoLink' => '#',
        'infoLink' => '#',
        'prisLink' => '#',
        'reglerLink' => '#',
        'faqLink' => '#',
        'kontaktLink' => '#' 
    ];

    protected $users;
    protected $places;
    protected $camp;

    public function index(){
        $camp = \App\camp::where('active', 1)->first();
        //$infos = \App\startpage_info::all();
        $contacts = \App\contact::all();
        $groups = \App\contact_group::orderBy('order', 'asc')->get();;
        $faqs = \App\faq::all();

        for($i = 0; $i < $groups->count(); $i++){
            $groups[$i]->populated = false; 
            foreach($contacts as $contact){
                if($contact->groupID == $groups[$i]->id){
                    $groups[$i]->populated = true;
                }
            }
        }

        $infos = \App\startpage_info::all();

        //return view('Pages/index', ['links' => $this->StartPagelinkslinks, 'camp' => $camp, 'infos' => $infos, 'contacts' => $contacts, 'groups' => $groups, 'faqs' => $faqs]);
        return view('Pages/index', ['links' => $this->StartPagelinkslinks, 'camp' => $camp, 'infos' => $infos, 'contacts' => $contacts, 'contact_groups' => $groups, 'faqs' => $faqs]);
    }

    public function template(){
        return view('Layouts/template');
    }

    public function login(){
        return view('Pages/login');
    }

    public function gdpr(){
        return view('Pages/gdpr');
    }

    

    public function dashboard(){
        $places = \App\place::all();
        $placesStats = [];

        for($i = 0; $i < count($places); $i++){
            $placesStats[] = new PlacesStats();
            end($placesStats)->place = $places[$i]->placename;

            $amountLeaders = \App\registrations_leader::where('place', '=', $places[$i]->placeID)->count();
            $amounParticipants = \App\registration::where('place', '=', $places[$i]->placeID)->count();

            end($placesStats)->amount = $amountLeaders + $amounParticipants;
        }

        return view('AdminPages/dashboard', ['placesStats' => $placesStats]);
    }

    public function registrationlists($type, $cancelled = false){
        
        $camp = \App\camp::where('active', 1)->first();
        $placesIDArray = [];
        $user = Auth::user();
        $places = \App\place::all();

        if($user->can('ljung')){
            $placesIDArray[] = \App\place::where('camp_id', $camp->id)->where('placename', '=', 'Ljung')->first()->placeID;
        }
        if($user->can('asklanda_ornunga')){
            $placesIDArray[] = \App\place::where('camp_id', $camp->id)->where('placename', '=', 'Asklanda-Ornunga')->first()->placeID;
        }
        if($user->can('bergstena_ostadkulle')){
            $placesIDArray[] = \App\place::where('camp_id', $camp->id)->where('placename', '=', 'Bergstena-Östadkulle')->first()->placeID;
        }
        if($user->can('borgstena_tamta')){
            $placesIDArray[] = \App\place::where('camp_id', $camp->id)->where('placename', '=', 'Borgstena-Tämta')->first()->placeID;
        }
        if($user->can('herrljunga')){
            $placesIDArray[] = \App\place::where('camp_id', $camp->id)->where('placename', '=', 'Herrljunga')->first()->placeID;
        }
        if($user->can('ljurhalla')){
            $placesIDArray[] = \App\place::where('camp_id', $camp->id)->where('placename', '=', 'Ljurhalla')->first()->placeID;
        }
        if($user->can('storsjostrand')){
            $placesIDArray[] = \App\place::where('camp_id', $camp->id)->where('placename', '=', 'Storsjöstrand')->first()->placeID;
        }
        if($user->can('t_r_e')){
            $placesIDArray[] = \App\place::where('camp_id', $camp->id)->where('placename', '=', 'Tåstorp/Rensvist/Eggvena/Lagmansholm')->first()->placeID;
        }
        if($user->can('vargarda')){
            $placesIDArray[] = \App\place::where('camp_id', $camp->id)->where('placename', '=', 'Vårgårda')->first()->placeID;
        }

        if($type == 'participant'){
            if($cancelled == "cancelled"){
                $regAmount = \App\registrations_cancel::where('camp_id', $camp->id)->count();
                $registrations = \App\registrations_cancel::where('camp_id', $camp->id)->whereIn('place', $placesIDArray)->get();
            }
            else{
                $regAmount = \App\registration::where('camp_id', $camp->id)->where('camp_id', $camp->id)->count();
                $registrations = \App\registration::where('camp_id', $camp->id)->whereIn('place', $placesIDArray)->get();
            }
            return view('AdminPages/registrationlists', ['registrations' => $registrations, 'places' => $places, 'count' => $regAmount, 'type' => $type, 'cancelled' => $cancelled]);
        }else if($type == 'leader'){
            if($cancelled == "cancelled"){
                $regAmount = \App\registrations_leaders_cancel::where('camp_id', $camp->id)->count();
                $registrations_leaders = \App\registrations_leaders_cancel::where('camp_id', $camp->id)->whereIn('place', $placesIDArray)->get();
            }
            else{
                $regAmount = \App\registrations_leader::where('camp_id', $camp->id)->count();
                $registrations_leaders = \App\registrations_leader::where('camp_id', $camp->id)->whereIn('place', $placesIDArray)->get();
            }
            return view('AdminPages/registrationlists', ['registrations' => $registrations_leaders, 'places' => $places, 'count' => $regAmount, 'type' => $type, 'cancelled' => $cancelled]);
        }else {
            return redirect('/invalidaddress');
        }
    }

    public function manageusers(){
        $users = \App\User::all();
        return view('AdminPages/managemebers', ['users' => $users]);
    }

    public function manageuser($id){
        $user = \App\User::find($id);
        $access = \App\accesslevel::find($id);
        return view('AdminPages/manageuser', ['user' => $user, 'access' => $access]);
    }

    public function registrationfull(){
        return view('Pages/registrationfull');
    }

    public function registrationExists(){
        return view('Pages/registrationexist');
    }

    public function managecamps(){
        $camps = \App\camp::all();
        $isInMaintenenceMode = App()->isDownForMaintenance();
        return view('AdminPages/managecamps', ['camps' => $camps, 'maintenenceMode' => $isInMaintenenceMode]);
    }

    public function managecamp($id){
        $camp = \App\camp::find($id);
        return view('AdminPages/managecamp', ['camp' => $camp]);
    }

    public function seminars(){
        $seminars = \App\seminar::all();
        $seminarInfo = \App\seminarinfo::all()->first();

        return view('AdminPages/manageSeminars', ['seminars' => $seminars, 'seminarInfo' => $seminarInfo]);
    }

    public function SaveSeminarInfo(){
        $seminarInfo = \App\seminarinfo::all()->first();

        $seminarInfo->description = Request("info");
        $seminarInfo->save();

        return redirect('/admin/seminars');
    }

    public function GameOfThrones(){
        $toilets = \App\gameofthrone::all();
        $info = \App\gameofthronesinfo::all()->first();
        
        return view('AdminPages/managegameofthrones', ['toilets' => $toilets, 'info' => $info]);
    }

    public function newGOT(){
        $toilet = new \App\gameofthrone();

        $toilet->name = Request('name');
        $toilet->description = Request('description');
        $toilet->responsible = Request('responsible');
        $toilet->place = Request('place');

        $toilet->save();
        
        return redirect('/admin/gameofthrones');
    }

    public function UpdateGameOfThrones(){
        $toilet = \App\gameofthrone::find(Request('id'));

        $toilet->name = Request('name');
        $toilet->description = Request('description');
        $toilet->responsible = Request('responsible');
        $toilet->place = Request('place');
        $toilet->wins = Request('wins');

        $toilet->save();

        return redirect('/admin/gameofthrones');
    }

    public function EditGameOfThrones($id){
        $toilet = \App\gameofthrone::find($id);

        return view('/adminPages/editGameOfThrones', ['toilet' => $toilet]);
    }

    public function DeleteGameOfThrones($id){
        $toilet = \App\gameofthrone::find($id);
        $toilet->delete();

        return redirect('/admin/gameofthrones');
    }

    public function UpdateGOTInfo($id){
        $info = \App\gameofthronesinfo::find($id);

        $info->description = Request('description');
        $info->link = Request('link');
        $info->vote_open = Request('vote_open');


        $info->save();

        return redirect('/admin/gameofthrones');
    }

    public function Insamling(){
        $insamling = \App\insamling::all()->first();

        return view('AdminPages/insamling', ['insamling' => $insamling]);
    }

    public function UpdateInsamling($id){
        $insamling = \App\insamling::find($id);
        $insamling->description = Request('description');

        $insamling->save();

        return redirect('/admin/insamling');
    }

    public function NewSeminar(){
        $seminar = new \App\seminar();

        $seminar->title = Request('title');
        $seminar->description = Request('description');
        $seminar->date = Request('date');
        $seminar->place = Request('place');
        $seminar->spots = Request('spots');
        $seminar->responsible = Request('responsible');
        $seminar->gym_plus = Request('gym_plus');

        $seminar->save();

        return redirect('/admin/seminars');
    }

    public function UpdateSeminar(){
        $seminar = \App\seminar::find(Request('id'));

        $seminar->title = Request('titel');
        $seminar->description = Request('description');
        $seminar->date = Request('date');
        $seminar->place = Request('place');
        $seminar->spots = Request('spots');
        $seminar->responsible = Request('responsible');
        $seminar->gym_plus = Request('gym_plus');

        $seminar->save();

        return redirect('/admin/seminars');
    }

    public function DeleteSeminar($id) {
        $seminar = \App\seminar::find($id);
        $seminar->delete();
        return redirect('/admin/seminars');
    }

    public function EditSeminar($id) {
        $seminar = \App\seminar::find($id);
        return view('AdminPages/editSeminar', ['seminar' => $seminar]);
    }

    public function CloseRegistration($id){
        $camp = \App\camp::find($id);
        $camp->open = 0;
        $camp->save();
        return redirect('/admin/managecamp/camp/' . $camp->id);
    }

    public function OpenRegistration($id){
        $camp = \App\camp::find($id);
        $camp->open = 1;
        $camp->late_open = 0;
        $camp->save();
        return redirect('/admin/managecamp/camp/' . $camp->id);
    }

    public function CloseLateRegistration($id){
        $camp = \App\camp::find($id);
        $camp->late_open = 0;
        $camp->save();
        return redirect('/admin/managecamp/camp/' . $camp->id);
    }

    public function OpenLateRegistration($id){
        $camp = \App\camp::find($id);
        $camp->open = 0;
        $camp->late_open = 1;
        $camp->save();
        return redirect('/admin/managecamp/camp/' . $camp->id);
    }

    public function About(){
        return view('Pages/about');
    }

    public function invalidaddress(){
        return view('Pages/invalidaddress');
    }

    public function lateregistration(){
        $links = \App\late_registration_key::all();
        $registrations = \App\registrationqueue::all();
        return view('AdminPages/lateregistration', ['links' => $links, 'registrations' => $registrations]);
    }

    public function addLateRegistration(){
        $newLinkEntry = new \App\late_registration_key();
        $newLinkEntry->link_key = Request('message');
        if(Request('leader') == null){
            $newLink = url("/lateregistration") .'/'.Request('message');
            $newLinkEntry->leader = 0;
        }
        else {
            $newLink = url("/lateregistration-leader") .'/'.Request('message'); 
            $newLinkEntry->leader = 1;
        }
        $links = \App\late_registration_key::all();

        // Checks if link already exists
        foreach($links as $link){
            if($newLink == $link->link){
                return redirect('/');
            }
        }

        $newLinkEntry->link = $newLink;
        $newLinkEntry->save();

        return redirect('/admin/lateregistration');
    }

    public function removeLateRegistration($id){
        $link = \App\late_registration_key::find($id);
        $linkedQueuedRegistration = \App\registrationqueue::where("linkId", $link->id)->first();
        if($linkedQueuedRegistration != null){
            $linkedQueuedRegistration->linkId = null;
            $linkedQueuedRegistration->save();
        }
        $link->delete();
        return redirect('/admin/lateregistration');
    }

    public function NewAdminTemplateTemp(){
        return view('AdminPages/betaAdminTemplate');
    }

    // Remove before publishing. Just temp to develop verification email
    public function testmail(){
        $registration= new \App\Registration();
        //return request()->all();
        
        $registration->first_name = 'Karl';
        $registration->last_name = 'Karlsson';
        $registration->birthdate = 1337-13-37;
        $registration->last_four = 1337;
        $registration->address = 'EliteStreet 3';
        $registration->zip = 13337;
        $registration->city = 'Ljung';
        $registration->email = 'test@test.se';
        $registration->first_name_advocate = 'Anders';
        $registration->last_name_advocate = 'Andersson';
        $registration->place = 0;

        return view('Emails/registeredemail', ['registration' => $registration, 'link' => 'branaslagret.test']);
    }

    public function ToggleMaintenenceMode(){
        if(App()->isDownForMaintenance()){
            Artisan::call('up');
        }
        else{
            Artisan::call('down');
        }
        return redirect('admin/managecamps');
    }

    public function EditStart(){
        $infos = \App\startpage_info::all();
        $info_type = \App\startpage_type::all();
        $contacts = \App\contact::all();
        $contacts_group = \App\contact_group::orderBy('order', 'asc')->get();
        $faqs = \App\faq::all();

        return view('AdminPages/editstart', ['infos' => $infos, 'info_types' => $info_type,'faqs' => $faqs, 'contacts' => $contacts, 'contact_groups' => $contacts_group]);   
    }

    public function EditInfo($id){
        $info = \App\startpage_info::find($id);
        $info_type = \App\startpage_type::all();
        return view('AdminPages/editinfo', ['info' => $info, 'info_types' => $info_type]);   
    }

    public function SaveEditStart($id = false){
        if($id){
            $info = \App\startpage_info::find($id);
        }
        else {
            $info = new \App\startpage_info();
        }

        $info->title = Request('title');
        $info->body = Request('body');
        $info->type = Request('type');

        $info->save();

        return redirect('admin/editstart'); 
    }

    public function RemoveInfo($id){
        $info = \App\startpage_info::find($id);

        $info->delete();

        return redirect('admin/editstart'); 
    }

    public function SaveStartFaq($id = false){
        if($id){
            $faq = \App\faq::find($id);
        }
        else {
            $faq = new \App\faq();
        }

        $faq->question = Request('question');
        $faq->answer = Request('answer');

        $faq->save();

        return redirect('admin/editstart'); 
    }

    public function RemoveStartFaq($id){
        $faq = \App\faq::find($id);
        
        $faq->delete();

        return redirect('admin/editstart'); 
    }

    public function EditStartFaq($id){
        $faq = \App\faq::find($id);
        return view('AdminPages/editfaq', ['faq' => $faq]);
    }

    public function SaveStartContact($id = false){
        if($id){
            $contact = \App\contact::find($id);
        }
        else {
            $contact = new \App\contact();
        }

        $contact->groupID = Request('group');
        $contact->name = Request('name');
        $contact->contact_info = Request('contact_info');

        $contact->save();

        return redirect('admin/editstart'); 
    }  
    
    public function RemoveStartContact($id){
        $contact = \App\contact::find($id);

        $contact->delete();

        return redirect('admin/editstart'); 
    }  
    
    public function EditStartContact($id){
        $contact = \App\contact::find($id);
        $contact_groups = \App\contact_group::all();
        return view('AdminPages/editcontact', ['contact' => $contact, 'contact_groups' => $contact_groups]);
    }

    public function AddContactGroup() {
        $contact_group = new \App\contact_group();
        $contact_group->groupName = Request('name');
        $contact_group->order = \App\contact_group::orderby('order', 'asc')->get()->last()->order + 1;
        $contact_group->save();
        return redirect('admin/editstart');
    }

    public function EditContactGroup($id){
        $contact_group = \App\contact_group::find($id);
        //$contact_group->groupName = Request("groupName");
        return view('AdminPages/editcontactgroup', ['contact_group' => $contact_group]);
    }

    public function SaveContactGroup($id){
        $contact_group = \App\contact_group::find($id);
        $contact_group->groupName = Request("name");
        $contact_group->save();
        return redirect('admin/editstart');
    }

    public function RemoveContactGroup($id){
        $contacts_group = \App\contact_group::find($id);
        $contacts_group->delete();  
        return redirect('admin/editstart');
    }
    
    public function EditContactGroupOrder($id, $dir){
        $contact_other;
        $contact = \App\contact_group::find($id);

        if($dir == "up"){
            try{
                $contact_other = \App\contact_group::where('order', $contact->order - 1)->first();
            } catch(Exception $e) {
                return redirect('admin/editstart');
            }
        } else if ($dir == "down"){
            try{
                $contact_other = \App\contact_group::where('order', $contact->order + 1)->first();
            } catch(Exception $e) {
                return redirect('admin/editstart');
            }
        } else {
            return "Could not identify direction";
            return "Invalid direction";
        }
        
        $orderFrom = $contact->order;
        $orderTo = $contact_other->order;
        
        $contact->order = 999999;
        $contact->save();
        $contact_other->order = 555555;
        $contact_other->save();
        
        $contact->order = $orderTo;
        $contact->save();
        $contact_other->order = $orderFrom;
        $contact_other->save();
        
        return redirect('admin/editstart');
    }



    /************************************
     * 
    * Registration Queue
     * 
     ************************************/

     
    // Signup for late registration list
    public function Lateregistrationsignup(){
        $registration = new \App\registrationqueue();

        $registration->name = Request('name');
        $registration->email = Request('email');
        if(Request('phoneNumber') != null)
            $registration->phone = Request('phoneNumber');
        if(Request('leader') != null)
            $registration->leader = Request('leader');
        $registration->save();
        return redirect('/');
    }

    public function lateRegistrationQueue(){
        $registrationparticipants = \App\registrationqueue::where('leader', 0)->get();
        $registrationleaders = \App\registrationqueue::where('leader', 1)->get();
        return view('AdminPages/lateregistrationqueue', ['registrationparticipants' => $registrationparticipants, 'registrationleaders' => $registrationleaders]);
    }

    public function sendLateRegLink($leader, $registrationid){
        $registration = \App\registrationqueue::find($registrationid);
        if($registration == null){
            return redirect('/admin/lateregistration/queues');
        }
        
        $key = \App\late_registration_key::find($registration->linkId);
        if($key != null){
            \Mail::to($registration->email)->send(new LateRegistrationInvite($registration->name, $key->link));
            return redirect('/admin/lateregistration/queues');
        }

        $lateReg = new \App\late_registration_key();
        $lateReg->link_key = $this->getRandomString(rand(15, 25));

        if($registration->leader == 0){
            $newLink = url("/lateregistration") .'/'. $lateReg->link_key;
            $lateReg->leader = 0;
        }
        else {
            $newLink = url("/lateregistration-leader") .'/'. $lateReg->link_key;
            $lateReg->leader = 1;
        }
        $lateReg->link = $newLink;
        
        $links = \App\late_registration_key::all();
        // Checks if link already exists
        foreach($links as $link){
            if($newLink == $link->link){
                return redirect('/admin/lateregistration/queues');
            }
        }

        $lateReg->save();
        $registration->linkId = $lateReg->id;
        $registration->save();

        \Mail::to($registration->email)->send(new LateRegistrationInvite($registration->name, $newLink));

        return redirect('/admin/lateregistration/queues');
    }

    public function RemoveLateRegistrationFromQueue($id){
        $registration = \App\registrationqueue::find($id);
        if($registration->linkId != null) {
            $linkEntry = \App\late_registration_key::find($registration->linkId);
            $linkEntry->delete();
        }
        $registration->delete();
        return redirect('/admin/lateregistration/queues');
    }

    public function editSpots($camp_id){
        $places = \App\place::where('camp_id', $camp_id)->orderBy('placename', 'ASC')->get();
        return view('AdminPages/editSpots', ['places' => $places]);
    }

    public function saveSpots(Request $request, $id){
        $places = \App\place::where('camp_id', $id)->orderBy('placename', 'ASC')->get();

        foreach($places as $place){
            $place->spots = $request->input($place->placeID . '_max');
            $place->participateSpots = $request->input($place->placeID . '_participants');
            $place->leaderSpots = $request->input($place->placeID . '_leaders');
            $place->save();
        }
        return redirect('/admin/editSpots/' . $id);
    }

    private function getRandomString($length) { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
      
        for ($i = 0; $i < $length; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
      
        return $randomString; 
    } 
}

class PlacesStats {
    public $place;
    public $amount;
}
