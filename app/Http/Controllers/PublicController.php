<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Car;
use App\Models\Category;
use App\Models\Motor;
use App\Models\RentLogs;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->nama_mobil || $request->jumlah_kursi){
            $cars = Car::where('nama_mobil', 'like', '%'.$request->nama_mobil.'%')
                    ->where('jumlah_kursi', 'like', '%'.$request->jumlah_kursi.'%')->get();
            $motors = Motor::all()->sortBy('status');
        }else{
            $cars = Car::all()->sortBy('status');
            $motors = Motor::all()->sortBy('status');
        }
        
        return view('welcome.homepagee', ['car' => $cars , 'motor' => $motors]);
    }

    public function dashboard()
    {
        $user = Auth::user();
        $data = RentLogs::with('user')->where('user_id', $user->id)->whereNotNull('car_id')->orderBy('created_at', 'DESC')->get();
        return view('welcome.dashboard', ['data' => $data]);
    }
    public function dashboardmotor()
    {
        $user = Auth::user();
        $data = RentLogs::with('user')->where('user_id', $user->id)->whereNotNull('motor_id')->orderBy('created_at', 'DESC')->get();
        return view('welcome.dashboardmotor', ['data' => $data]);
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
        $daysfine = $intervalfine->days;

        $total = $data->pay + $data->fine;

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('pages.invoice.invoice', ['data' => $data, 'user' => $user, 'daysrent' => $daysrent, 'daysfine' => $daysfine, 'total' => $total, 'bank' => $bank]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function detail($slug)
    {
        $cars = Car::where('slug' , $slug)->first();
        return view('welcome.detail',  ['car' => $cars]);
    }

    public function detailmotor($slug)
    {
        $motors = Motor::where('slug' , $slug)->first();
        return view('welcome.detailmotor',  ['motor' => $motors]);
    }

    public function rentCustomer(Request $request, $slug)
    {
        $cars = Car::where('slug' , $slug)->first();
        $request['status'] = 0;
        $request['user_id'] = Auth::user()->id;
        $request['car_id'] = $cars->id;
        $car = Car::findOrFail($request->car_id);
        $jikakosong = date('Y-m-d', strtotime($request->rent_date. ' + 5 days'));
        
        $rent_date = strtotime($request->rent_date);
        $return_date = strtotime($request->return_date);
        $rental_duration = $return_date - $rent_date; // number of seconds between rent_date and return_date
        $rental_days = $rental_duration / 86400; // number of days between rent_date and return_date
        $rental_price = $rental_days * $car->harga_sewa; // total rental price

        $user = Auth::user();
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

        // Add rental price to request array
        $request['pay'] = $rental_price;
        $request['no_invoice'] = $no_invoice;
        if($request['return_date'] == ''){ 
            $request['return_date'] = $jikakosong;
        }

        try{
            DB::beginTransaction();
            // process insert to rent_logs
            $rents = RentLogs::create($request->all());
            // process update cars table
            $car = Car::findOrFail($request->car_id);
            $car->status = 'tidak tersedia';
            $car->update();
            DB::commit();

            $rents->notify(new \App\Notifications\SendNotification());

            return redirect('cart')->with('success', 'Book successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
    public function rentCustomermotor(Request $request, $slug)
    {
        $motors = Motor::where('slug' , $slug)->first();
        $request['status'] = 0;
        $request['user_id'] = Auth::user()->id;
        $request['motor_id'] = $motors->id;
        $motor = Motor::findOrFail($request->motor_id);
        $jikakosong = date('Y-m-d', strtotime($request->rent_date. ' + 5 days'));
        
        $rent_date = strtotime($request->rent_date);
        $return_date = strtotime($request->return_date);
        $rental_duration = $return_date - $rent_date; // number of seconds between rent_date and return_date
        $rental_days = $rental_duration / 86400; // number of days between rent_date and return_date
        $rental_price = $rental_days * $motor->harga_sewa; // total rental price

        $user = Auth::user();
        $username = $user->username;
        // Generate no_invoice field
        $customer_name = str_replace(',', '', $username);
        $motor_name = $motor->nama_motor;
        $motor_name_length = strlen($motor_name);
        $customer_name_length = strlen($customer_name);
        $no_invoice = strtoupper(substr($motor_name, 0, 1) // First letter of car name
                    . substr($motor_name, (int) ($motor_name_length / 2), 1) // Middle letter of car name
                    . substr($motor_name, -1) // Last letter of car name
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
            $rents = RentLogs::create($request->all());
            // process update motors table
            $motor = Motor::findOrFail($request->motor_id);
            $motor->status = 'tidak tersedia';
            $motor->update();
            DB::commit();

            // $rents->notify(new \App\Notifications\SendNotificationMotor());
            $rents->notify(new \App\Notifications\CarWhatsappNotification());
            return redirect('cartmotor')->with('success', 'Book successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
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
