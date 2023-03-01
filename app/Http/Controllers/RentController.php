<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Car;
use App\Models\Motor;
use App\Models\RentLogs;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            $end_date = Carbon::parse($end_date)->addDays(1);
            $rentlogs = RentLogs::whereNotNull('car_id')->whereBetween('created_at', [$start_date, $end_date])->orderBy('created_at', 'DESC')->get();
        } else if ($start_date) {
            $rentlogs = RentLogs::whereNotNull('car_id')->whereDate('created_at', $start_date)->orderBy('created_at', 'DESC')->get();
        } else {
            $rentlogs = RentLogs::whereNotNull('car_id')->orderBy('created_at', 'DESC')->get();
        }

        return view('pages.rent.rentcar', ['rent_logs' => $rentlogs]);
    }

    public function printInvoice($id)
    {   
        $data = RentLogs::find($id);
        $user = User::findOrFail($data->user_id);
        $bank = Bank::where('id', '1')->first();
        $rentDate = new DateTime($data->rent_date);
        $returnDate = new DateTime($data->return_date);
        $actualreturnDate = new DateTime($data->actual_return_date);

        $intervalrent = $returnDate->diff($rentDate);
        $intervalfine = $actualreturnDate->diff($returnDate);

        $daysrent = $intervalrent->days;
        $daysfine = $intervalfine->days + 1;

        $total = $data->pay + $data->fine;

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('pages.invoice.invoice', ['data' => $data, 'user' => $user, 'daysrent' => $daysrent, 'daysfine' => $daysfine, 'total' => $total, 'bank' => $bank]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream();
        
    }

    public function filtermobil(Request $request)
    {
        $start_date= $request->input('start_date');
        $end_date = $request->input('end_date');
        
        if ($start_date && $end_date) {
            $rentlogs = RentLogs::whereNotNull('car_id')->whereBetween('created_at', [$start_date, $end_date])->get();
        } else if ($start_date) {
            $rentlogs = RentLogs::whereNotNull('car_id')->whereDate('created_at', $start_date)->get();
        } else {
            $rentlogs = RentLogs::whereNotNull('car_id')->get();
        }

        return view('pages.rent.rentcar', ['rent_logs' => $rentlogs]);
    }
                    
    

    public function indexmotor(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            $end_date = Carbon::parse($end_date)->addDays(1);
            $rentlogs = RentLogs::whereNotNull('motor_id')->whereBetween('created_at', [$start_date, $end_date])->orderBy('created_at', 'DESC')->get();
        } else if ($start_date) {
            $rentlogs = RentLogs::whereNotNull('motor_id')->whereDate('created_at', $start_date)->orderBy('created_at', 'DESC')->get();
        } else {
            $rentlogs = RentLogs::whereNotNull('motor_id')->orderBy('created_at', 'DESC')->get();
        }

        return view('pages.rentmotor.rentmotor', ['rent_logs' => $rentlogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cars = Car::where('status', '=', 'tersedia')->get();
        $users = User::where('role_id', '=', 3)->get();
        return view('pages.rent.create', ['users' => $users, 'cars' => $cars]);
    }

    public function createmotor()
    {
        $motors = Motor::where('status', '=', 'tersedia')->get();
        $users = User::where('role_id', '=', 3)->get();
        return view('pages.rentmotor.create', ['users' => $users, 'motors' => $motors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        // $rentdate = $request['rent_date'];
        // $jikakosong = $rentdate = Carbon::parse($request->rent_date)->addDays(3);
        $request['status'] = 1;
        $car = Car::findOrFail($request->car_id);
        $jikakosong = date('Y-m-d', strtotime($request->rent_date. ' + 5 days'));

        $rent_date = strtotime($request->rent_date);
        $return_date = strtotime($request->return_date);
        $actual_return_date = strtotime($request->actual_return_date);
        $rental_duration = $return_date - $rent_date; // number of seconds between rent_date and return_date
        $rental_days = $rental_duration / 86400; // number of days between rent_date and return_date
        $rental_price = $rental_days * $car->harga_sewa; // total rental price
        if($request['delivery'] == ''){
            $request['delivery'] = 'Office';
        }

        $user = User::findOrFail($request->user_id);
        $username = $user->username;
        // Generate no_invoice field
        $customer_name = str_replace(',', '', $username);
        $car_name = $car->nama_mobil;
        $car_name_length = strlen($car_name);
        $customer_name_length = strlen($customer_name);
        $no_invoice = strtoupper(substr($car_name, 0, 1) // First letter of car name
                    . substr($car_name, (int) ($car_name_length / 2), 1) // Middle letter of car name
                    . substr($car_name, -1) // Last letter of car name
                    . substr($customer_name, 0, 1) // First letter of customer name
                    . substr($customer_name, (int) ($customer_name_length / 2), 1) // Middle letter of customer name
                    . substr($customer_name, -1) // Last letter of customer name
                    . date('Ymd'));

        // Add rental price and no_invoice to request array
        $request['pay'] = $rental_price;
        $request['no_invoice'] = $no_invoice;
        if($request['return_date'] == ''){ 
            $request['return_date'] = $jikakosong;
        }

        try{
            DB::beginTransaction();
            // process insert to rent_logs
            RentLogs::create($request->all());
            // process update cars table
            $car = Car::findOrFail($request->car_id);
            $car->status = 'tidak tersedia';
            $car->update();
            DB::commit();

            return redirect('rentcar')->with('success', 'Rent successfully added.');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function storemotor(Request $request) 
    {
        // $rentdate = $request['rent_date'];
        // $jikakosong = $rentdate = Carbon::parse($request->rent_date)->addDays(3);
        $request['status'] = 1;
        $motor = Motor::findOrFail($request->motor_id);
        $jikakosong = date('Y-m-d', strtotime($request->rent_date. ' + 2 days'));
        
        $rent_date = strtotime($request->rent_date);
        $return_date = strtotime($request->return_date);
        $rental_duration = $return_date - $rent_date; // number of seconds between rent_date and return_date
        $rental_days = $rental_duration / 86400; // number of days between rent_date and return_date
        $rental_price = $rental_days * $motor->harga_sewa; // total rental price
        if($request['delivery'] == ''){
            $request['delivery'] = 'Office';
        }

        $user = User::findOrFail($request->user_id);
        $username = $user->username;
        // Generate no_invoice field
        $customer_name = str_replace(',', '', $username);
        $motor_name = $motor->nama_motor;
        $motor_name_length = strlen($motor_name);
        $customer_name_length = strlen($customer_name);
        $no_invoice = strtoupper(substr($motor_name, 0, 1) // First letter of motor name
                    . substr($motor_name, (int) ($motor_name_length / 2), 1) // Middle letter of motor name
                    . substr($motor_name, -1) // Last letter of motor name
                    . substr($customer_name, 0, 1) // First letter of customer name
                    . substr($customer_name, (int) ($customer_name_length / 2), 1) // Middle letter of customer name
                    . substr($customer_name, -1) // Last letter of customer name
                    . date('Ymd'));

        // Add rental price to request array
        $request['pay'] = $rental_price;
        $request['no_invoice'] = $no_invoice;
        if($request['return_date'] == ''){ 
            $request['return_date'] = $jikakosong;
        }

        try{
            DB::beginTransaction();
            // process insert to rent_logs
            RentLogs::create($request->all());
            // process update motors table
            $motor = Motor::findOrFail($request->motor_id);
            $motor->status = 'tidak tersedia';
            $motor->update();
            DB::commit();

            return redirect('rentmotor')->with('success', 'Rent successfully added.');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }


    public function returnCar($id)
    {
        $rent = RentLogs::where('id', $id)->first();
        return view('pages.rent.rentreturn', ['rent' => $rent]);
    }

    public function returnMotor($id)
    {
        $rent = RentLogs::where('id', $id)->first();
        return view('pages.rentmotor.rentreturn', ['rent' => $rent]);
    }

    public function returnCarupdate(Request $request, $id)
    {
        $rent = RentLogs::where('id', $id)->first();
        $dendamobil = $rent->car->denda;
        $dueDateString = $rent->return_date;
        $actualReturnDateString = $request->input('actual_return_date');

        $dueDate = new DateTime($dueDateString);
        $actualReturnDate = new DateTime($actualReturnDateString);

        $return_at = $request->return_at;
        if($request['return_at'] == ''){
            $request['return_at'] = 'Office';
        }

        if ($actualReturnDate < $dueDate) {
            $lateFee = 0;
        } else {
            $interval = $dueDate->diff($actualReturnDate);
            $daysLate = $interval->days;
            $lateFee = $daysLate * $dendamobil;
        }

        $request['fine'] = $lateFee;
        
        $rent->update($request->all());
        $rent->car->update(['status' => 'tersedia']);
        return redirect('rentcar')->with('success', 'Actual Return Car successfully added.');
    }

    public function returnMotorupdate(Request $request, $id)
    {
        $rent = RentLogs::where('id', $id)->first();
        $dendamotor = $rent->motor->denda;
        $dueDateString = $rent->return_date;
        $actualReturnDateString = $request->input('actual_return_date');

        $dueDate = new DateTime($dueDateString);
        $actualReturnDate = new DateTime($actualReturnDateString);

        $return_at = $request->return_at;
        if($request['return_at'] == ''){
            $request['return_at'] = 'Office';
        }

        if ($actualReturnDate < $dueDate) {
            $lateFee = 0;
        } else {
            $interval = $dueDate->diff($actualReturnDate);
            $daysLate = $interval->days;
            $lateFee = $daysLate * $dendamotor;
        }

        $request['fine'] = $lateFee;
        
        $rent->update($request->all());
        $rent->motor->update(['status' => 'tersedia']);
        return redirect('rentmotor')->with('success', 'Actual Return Motor successfully added.');
    }

    public function returnCaredit($id)
    {
        $user = User::all();
        $car = Car::all();
        $rent = RentLogs::where('id', $id)->first();
        return view('pages.rent.rentreturnedit', ['rent' => $rent, 'user' => $user, 'car' => $car]);
    }

    public function returnMotoredit($id)
    {
        $user = User::all();
        $motor = Motor::all();
        $rent = RentLogs::where('id', $id)->first();
        return view('pages.rentmotor.rentreturnedit', ['rent' => $rent, 'user' => $user, 'motor' => $motor]);
    }

    public function returnCareditUpdate(Request $request, $id)
    {
        $rent = RentLogs::where('id', $id)->first();
        $dendamobil = $rent->car->denda;
        $dueDateString = $rent->return_date;
        $actualReturnDateString = $request->input('actual_return_date');

        $dueDate = new DateTime($dueDateString);
        $actualReturnDate = new DateTime($actualReturnDateString);

        if ($actualReturnDateString == null || $actualReturnDate < $dueDate) {
            $lateFee = 0;
        } else {
            $interval = $dueDate->diff($actualReturnDate);
            $daysLate = $interval->days;
            $lateFee = $daysLate * $dendamobil;
        }
        $request['fine'] = $lateFee;
        $rent->update($request->all());
        return redirect('rentcar')->with('success', 'Rent successfully updated.');
    }

    public function returnMotoreditUpdate(Request $request, $id)
    {
        $rent = RentLogs::where('id', $id)->first();
        $dendamotor = $rent->motor->denda;
        $dueDateString = $rent->return_date;
        $actualReturnDateString = $request->input('actual_return_date');

        $dueDate = new DateTime($dueDateString);
        $actualReturnDate = new DateTime($actualReturnDateString);

        if ($actualReturnDateString == null || $actualReturnDate < $dueDate) {
            $lateFee = 0;
        } else {
            $interval = $dueDate->diff($actualReturnDate);
            $daysLate = $interval->days;
            $lateFee = $daysLate * $dendamotor;
        }
        $request['fine'] = $lateFee;
        $rent->update($request->all());
        return redirect('rentmotor')->with('success', 'Rent successfully updated.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = RentLogs::find($id);
        return view('pages.rent.detail', ['data' => $data ]);
    }

    public function showmotor($id)
    {
        $data = RentLogs::find($id);
        return view('pages.rentmotor.detail', ['data' => $data ]);
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
        $rent = RentLogs::where('id', $id)->first();
        $rent->delete();
        return redirect()->back()->with('success', 'Rent successfully deleted.');
    }

    public function updateStatus(Request $request, $id)
    {

        $rent = RentLogs::where('id', $id)->first();

        $currenttime = Carbon::Now();
        $rent->update([
            'status' => $request->status,
            'updated_at' => $currenttime,
        ]);

        
        return redirect()->back()->with('success', 'Status rent successfully updated.');
    }
}
