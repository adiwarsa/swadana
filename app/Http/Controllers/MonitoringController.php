<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;
use DateTime;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car = RentLogs::where('status','1')
            ->whereNotNull('car_id')
            ->whereNull('actual_return_date')
            ->get(); // Get all RentLogs with non-null car_id
        foreach ($car as $item) { // Loop through each RentLogs item
            $returnDate = new DateTime($item->return_date); // Create DateTime object for return_date
            $now = new DateTime(); // Create DateTime object for current time
            $intervalfine = $now->diff($returnDate); // Calculate the interval between the return_date and now
            $daysfine = $intervalfine->days; // Get the number of days between the return_date and now
            if ($daysfine > 0) {
                $denda = $daysfine * $item->car->denda;
                $item->denda = $denda;
                $item->daysfine = $daysfine; // Add the number of days to the RentLogs item as a new property
            } else {
                $item->denda = 0;
                $item->daysfine = 0;
            }
        }
        return view('pages.monitor.car', ['car' => $car]); // Return the view with the RentLogs data (including the new "daysfine" property)
    }

    public function indexmotor()
    {
        $motor = RentLogs::where('status','1')
            ->whereNotNull('motor_id')
            ->whereNull('actual_return_date')
            ->get();
            foreach ($motor as $item) { // Loop through each RentLogs item
                $returnDate = new DateTime($item->return_date); // Create DateTime object for return_date
                $now = new DateTime(); // Create DateTime object for current time
                $intervalfine = $now->diff($returnDate); // Calculate the interval between the return_date and now
                $daysfine = $intervalfine->days; // Get the number of days between the return_date and now
                if ($daysfine > 0) {
                    $denda = $daysfine * $item->motor->denda;
                    $item->denda = $denda;
                    $item->daysfine = $daysfine; // Add the number of days to the RentLogs item as a new property
                } else {
                    $item->denda = 0;
                    $item->daysfine = 0;
                }
        }
        return view('pages.monitor.motor', ['motor' => $motor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
