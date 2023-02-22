<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Motor;
use App\Models\Samsat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SamsatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car = Car::where('samsat', '<=', Carbon::now()->addDays(15))
                ->where('remind', '=', '0')
                ->get();
        $samsat = Samsat::whereNotNull('car_id')->get();
        return view('pages.samsat.samsat', ['samsat' => $samsat, 'car' => $car]);
    }

    public function indexmotor()
    {
        $motor = Motor::where('samsat', '<=', Carbon::now()->addDays(15))
                ->where('remind', '=', '0')
                ->get();
        $samsat = Samsat::whereNotNull('motor_id')->get();
        return view('pages.samsatmotor.samsat', ['samsat' => $samsat, 'motor' => $motor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $car = Car::where('samsat', '<=', Carbon::now()->addDays(15))
        //         ->where('remind', '=', '0')
        //         ->get();
        // return view('pages.samsat.create', ['cars' => $car]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $samsatData = [
        //     'car_id' => $request->car_id,
        //     'renew_samsat' => Carbon::now(),
        // ];
        $car = Car::findOrFail($request->car_id);
        $car_name = $car->nama_mobil;
        $car_name_length = strlen($car_name);
        $code_samsat = strtoupper(substr($car_name, 0, 1) // First letter of car name
            . substr($car_name, (int) ($car_name_length / 2), 1) // Middle letter of car name
            . substr($car_name, -1) // Last letter of car name
            . '-' . date('Ymd'));

        Samsat::create([
            'car_id' => $car->id,
            'old_samsat' => $car->samsat,
            'code_samsat' => $code_samsat,
        ]);
        $car->update(['remind' => 1]);
        return redirect('samsat')->with('success', 'Samsat successfully added.');
    }

    public function storemotor(Request $request)
    {
        // $samsatData = [
        //     'car_id' => $request->car_id,
        //     'renew_samsat' => Carbon::now(),
        // ];
        $motor = Motor::findOrFail($request->motor_id);
        $motor_name = $motor->nama_motor;
        $motor_name_length = strlen($motor_name);
        $code_samsat = strtoupper(substr($motor_name, 0, 1) // First letter of motor name
            . substr($motor_name, (int) ($motor_name_length / 2), 1) // Middle letter of motor name
            . substr($motor_name, -1) // Last letter of motor name
            . '-' . date('Ymd'));


        Samsat::create([
            'motor_id' => $motor->id,
            'old_samsat' => $motor->samsat,
            'code_samsat' => $code_samsat,
        ]);
        $motor->update(['remind' => 1]);
        return redirect('samsatmotor')->with('success', 'Samsat successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRenew($id)
    {
        $samsat = Samsat::where('id', $id)->first();
        return view('pages.samsat.samsatrenew', ['samsat' => $samsat]);
    }

    public function editRenewmotor($id)
    {
        $samsat = Samsat::where('id', $id)->first();
        return view('pages.samsatmotor.samsatrenew', ['samsat' => $samsat]);
    }

     public function updateRenew(Request $request, $id)
     {
        $samsat = Samsat::where('id', $id)->first();
        $samsatData = [
            'new_samsat' => $request->new_samsat,
            'renew_samsat' => Carbon::now(),
        ];
        $samsat->update($samsatData);
        $carData = [
            'updated_at' => Carbon::now(),
            'samsat' => $request->new_samsat,
            'remind' => 0,
        ];
        $samsat->car->update($carData);
        return redirect('samsat')->with('success', 'Samsat successfully renew.');
    }

    public function updateRenewmotor(Request $request, $id)
     {
        $samsat = Samsat::where('id', $id)->first();
        $samsatData = [
            'new_samsat' => $request->new_samsat,
            'renew_samsat' => Carbon::now(),
            'remind' => 0,
        ];
        $samsat->update($samsatData);
        $motorData = [
            'updated_at' => Carbon::now(),
            'samsat' => $request->new_samsat,
        ];
        $samsat->motor->update($motorData);
        return redirect('samsatmotor')->with('success', 'Samsat successfully renew.');
    }

    public function show($id)
    {
        $data = Samsat::find($id);
        return view('pages.samsat.detail', ['data' => $data ]);
    }

    public function showmotor($id)
    {
        $data = Samsat::find($id);
        return view('pages.samsatmotor.detail', ['data' => $data ]);
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
        $samsat = Samsat::where('id', $id)->first();
        $samsat->delete();
        return redirect()->back()->with('success', 'Samsat successfully deleted.');
    }
}
