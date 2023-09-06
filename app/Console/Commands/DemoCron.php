<?php

namespace App\Console\Commands;

use App\Mail\TestMail;
use App\Mail\TestMail2;
use App\Models\Car;
use App\Models\Motor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


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
        $phone = '6289621791541';
            if ($car){
            Mail::to($user)->send(new TestMail($car));
            $car->remind = 1;
            $car->save();
            $message = 'Halo *Nyoman*, Samsat Car *' . $car->nama_mobil . '*
Plat *' .$car->plat. '*
Being outdated at *' .$car->samsat.'*


Please check your email!' ;
            $fonnte =  Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Tczj4s4vqhpBr6kitTbj',
            ])->asForm()->post('https://api.fonnte.com/send', [
                "target" => $phone,
                "type"  => "text",
                "message" => $message,
                "delay" => 3,
                'templateJSON' => '{"message":"fonnte template message","footer":"fonnte footer message","buttons":[{"message":"fonnte","url":"https://fonnte.com"}]}',
            ]);
            Log::info("Fonnte " . $fonnte->body() .  $phone);
        }
        if ($motor){
            Mail::to($user)->send(new TestMail2($motor));
            $motor->remind = 1;
            $motor->save();
            $message = 'Halo *Nyoman*, Samsat Motor *' . $motor->nama_motor . '*
Plat *' .$motor->plat. '*
Being outdated at *' .$motor->samsat.'*


Please check your email!' ;
            $fonnte =  Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Tczj4s4vqhpBr6kitTbj',
            ])->asForm()->post('https://api.fonnte.com/send', [
                "target" => $phone,
                "type"  => "text",
                "message" => $message,
                "delay" => 3,
            ]);
            Log::info("Fonnte " . $fonnte->body() .  $phone);
        }
    }
}
