<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class OpenRegistration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Registration:Open';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Opens the registration of the active camp if the registration open date time has past';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $camp = \App\camp::where('active', 1)->first();
        $currentTime = Carbon::now();

        // If no active camp is found, do nothing
        if($camp == null){
            return;
        }

        // Check if some criterias are met. If they are, keep the registration closed
        if($this->keepClosed($camp, $currentTime)){
            return;
        }

        // Check if time is after registration is open and 
        if($camp->registrationOpen <= $currentTime){
            $camp->late_open = 0;
            $camp->open = 1;
            $camp->save();
        }
    }

    private function keepClosed($camp, $currentTime){
        $registeredParticipants = \App\registration::count();
        $registeredLeaders = \App\registrations_leader::count();

        // Check if limit is reached
        if($registeredLeaders >= $camp->leaderSpots && $registeredParticipants >= $camp->participantSpots){
            return true;
        }
        
        // If we are after the time of registration closes, keep the registration closed
        if($currentTime >= $camp->registrationCloses){
            return true;
        }

        // If late registration is open, keep the normal registration closed
        if($camp->late_open == 1){
            return true;
        }

        return false;
    }
}
