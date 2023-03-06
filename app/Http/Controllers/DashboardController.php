<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Vendor;
use App\Models\RentLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;


class DashboardController extends Controller
{
    public function index()
    {
        $carcount = RentLogs::whereNotNull('car_id')
                    ->whereNull('actual_return_date')
                    ->where('status', 1)
                    ->count();
        $motorcount = RentLogs::whereNotNull('motor_id')
                    ->whereNull('actual_return_date')
                    ->where('status', 1)    
                    ->count();
        $usercount = User::count();

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        //menghitung this week money from car
        $rentLogscar = RentLogs::whereBetween('created_at', [$startOfWeek, Carbon::now()])
                    ->whereNotNull('car_id')->where('status', 1)
                    ->get();
        $totalPaycar = $rentLogscar->sum('pay');
        $totalPaycarrupiah = 'Rp ' . number_format($totalPaycar, 0, ',', '.');

        //menghitung this week money from motor
        $rentLogsmotor = RentLogs::whereBetween('created_at', [$startOfWeek, Carbon::now()])
                    ->whereNotNull('motor_id')->where('status', 1)
                    ->get();
        $totalPaymotor = $rentLogsmotor->sum('pay');
        $totalPaymotorrupiah = 'Rp ' . number_format($totalPaymotor, 0, ',', '.');


        $now = Carbon::now();
        $mingguini = Carbon::now()->startOfWeek();
        $mingguini->settings(['formatFunction' => 'translatedFormat']);
        $now->settings(['formatFunction' => 'translatedFormat']);
        
        // Menentukan hari dalam seminggu yang ingin ditampilkan
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        // membuat 7 array elemen dan mengisi dengan 0
        $counts = array_fill(0, 7, 0);

        // Query the rent logs where the `car_id` column is not null, and where the `created_at` column is between the start and end of the current week.
        // Select the day of the week and the count of logs, and group by day of the week.
        $chartmobil = RentLogs::whereNotNull('car_id')
                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                    ->selectRaw('DATE_FORMAT(created_at, "%W") as day_of_week, count(*) as count')
                    ->groupBy('day_of_week')
                    ->get();

        // Loop through each data item in the result set
        foreach ($chartmobil as $data) {
            // Find the index of the day of the week in the `$days` array.
            $index = array_search($data->day_of_week, $days);
            
            // Update the `$counts` array at the corresponding index with the count of logs for that day.
            $counts[$index] = $data->count;
        }

        $counts2 = array_fill(0, 7, 0);

        $chartmotor = RentLogs::whereNotNull('motor_id')
                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                    ->selectRaw('DATE_FORMAT(created_at, "%W") as day_of_week, count(*) as count')
                    ->groupBy('day_of_week')
                    ->get();

        // Loop through each data item in the result set
        foreach ($chartmotor as $data) {
            // Find the index of the day of the week in the `$days` array.
            $index = array_search($data->day_of_week, $days);
            
            // Update the `$counts` array at the corresponding index with the count of logs for that day.
            $counts2[$index] = $data->count;
        }

        
        //Chart Rent Mobil setiap bulan
        $currentYear = Carbon::now()->year;
        $mobilbulan = RentLogs::select('id', 'created_at')
            ->whereNotNull('car_id')
            ->whereYear('created_at', $currentYear)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });

        $mobilmcount = [null, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // add a null value at the beginning

        foreach ($mobilbulan as $key => $value) {
            $mobilmcount[(int)$key] = count($value);
        }

        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($mobilmcount[$i])) {
                $mobilArr[$i]['count'] = $mobilmcount[$i];
            } else {
                $mobilArr[$i]['count'] = 0;
            }
            $mobilArr[$i]['month'] = $month[$i - 1];
        }
        $arraymobilcount = array_column($mobilArr, 'count');
        $arraybulan = array_column($mobilArr, 'month');
        $varbul = [$arraybulan];
        $var = [$arraymobilcount];


        //Chart Rent Motor setiap bulan
        $currentYear = Carbon::now()->year;
        $motorbulan = RentLogs::select('id', 'created_at')
            ->whereNotNull('motor_id')
            ->whereYear('created_at', $currentYear)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });

        $motormcount = [null, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // add a null value at the beginning

        foreach ($motorbulan as $key => $value) {
            $motormcount[(int)$key] = count($value);
        }

        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($motormcount[$i])) {
                $motorArr[$i]['count'] = $motormcount[$i];
            } else {
                $motorArr[$i]['count'] = 0;
            }
            $motorArr[$i]['month'] = $month[$i - 1];
        }
        $arraymotorcount = array_column($motorArr, 'count');
        $arrayblnm = array_column($motorArr, 'month');
        $varbulm = [$arrayblnm];
        $varm = [$arraymotorcount];

        return view('dashboard.index', ['totalPaycarrupiah' => $totalPaycarrupiah,'totalPaymotorrupiah' => $totalPaymotorrupiah,'startOfWeek' => $startOfWeek, 'carcount' => $carcount,'motorcount' => $motorcount,'usercount' => $usercount, 'mingguini' => $mingguini, 'counts' => $counts, 'counts2' => $counts2, 'now' => $now, 'var' => $var,'varm' => $varm, 'varbulm' => $varbulm, 'varbul' => $varbul]);
    }

}
