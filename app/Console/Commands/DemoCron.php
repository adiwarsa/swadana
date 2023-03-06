<?php

namespace App\Console\Commands;

use App\Mail\TestMail;
use App\Mail\TestMail2;
use App\Models\Car;
use App\Models\Motor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $limabelas = Carbon::now()->subDay(15);
        // // $car = Car::where('samsat', '>=', $limabelas)->first();
        // $car = Car::where(['samsat', '>=', $limabelas,
        // 'remind', "=" , '0'])->first();
        $car = Car::where('samsat', '<=', Carbon::now()->addDays(30))
                ->where('remind', '=', '0')
                ->first();
        $motor = Motor::where('samsat', '<=', Carbon::now()->addDays(30))
        ->where('remind', '=', '0')
        ->first();
        $user = new User();
        $user->email = 'adiganteng630@gmail.com';
        // if ((new \Carbon\Carbon($car->samsat))->diffInDays() <= 15){
        if ($car){
            Mail::to($user)->send(new TestMail($car));
            $car->remind = 1;
            $car->save();
        }
        if ($motor){
            Mail::to($user)->send(new TestMail2($motor));
            $motor->remind = 1;
            $motor->save();
        }
    }
}
