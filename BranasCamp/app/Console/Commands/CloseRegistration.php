<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class CloseRegistration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Registration:Close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Closes the registration of the active camp if the registration Close date time has past';

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
        
        // If no active camp is found, do nothing
        if($camp == null){
            return;
        }
        
        // If both registration and late regisration is closed, do nothing. Everything should be closed.
        if($camp->open == 0){
            return;
        }
        
        $currentTime = Carbon::now();
        if($currentTime >= $camp->registrationCloses){
            $camp->open = 0;
            $camp->late_open = 1;
            $camp->save();
        }
    }
}
