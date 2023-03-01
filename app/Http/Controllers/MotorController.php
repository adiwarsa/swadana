<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Category;
use App\Models\Samsat;
use App\Models\Vendor;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;


class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motor = Motor::with('vendors')->orderBy('status')->get();
        return view('pages.motor.motor', ['motor' => $motor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor = Vendor::where('type', '2')->get();
        $categories = Category::where('type','2')->get();
        return view('pages.motor.create', ['vendor' => $vendor , 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_motor' => 'required|unique:motors|max:255',
        ]);

        $newName= '';
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->nama_mobil.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('gambar', $newName);
        }

        $request['gambar'] = $newName;
        $remind = 0;
        $motor = Motor::create($request->all() + ['remind' => $remind]);
        $motor->categories()->sync($request->categories);
        return redirect('motor')->with('success', 'Motor successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Motor::find($id);
        return view('pages.motor.detail', ['data' => $data ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $motor = Motor::where('slug', $slug)->first();
        $vendor = Vendor::where('type', '2')->get();
        $categories = Category::where('type','2')->get();
        return view('pages.motor.edit',['vendor' => $vendor , 'categories' => $categories, 'motor' => $motor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->nama_mobil.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('gambar', $newName);
            $request['gambar'] = $newName;
        }
       
        $motor = Motor::where('slug', $slug)->first();
        $motor->update($request->all());

        if($request->categories){
            $motor->categories()->sync($request->categories);
        }
        return redirect('motor')->with('success', 'Motor successfully changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $motor = Motor::where('slug', $slug)->first();
        $motor->delete();
        return redirect('motor')->with('success', 'Motor successfully deleted.');
    }

    public function updateStatusAndCreateSamsat($id)
    {

        // Find the car with the specified ID or throw an exception if it doesn't exist
        $motor = Motor::findOrFail($id);

        // Update the remind field of the motor model
        $motor->remind = 1;
        $motor->save();

        // Generate the kode_samsat value using the motor name and current date
        $motor_name = $motor->nama_motor;
        $motor_name_length = strlen($motor_name);
        $code_samsat = strtoupper(substr($motor_name, 0, 1) // First letter of motor name
            . substr($motor_name, (int) ($motor_name_length / 2), 1) // Middle letter of motor name
            . substr($motor_name, -1) // Last letter of car name
            . '-' . date('Ymd')); // Current date in Ymd format

            // Check if the kode_samsat value already exists
            $existing_samsat = Samsat::where('code_samsat', $code_samsat)->first();
            if ($existing_samsat) {
            // Return an error message if the kode_samsat value already exists
            return redirect('dashboard')->with('error', 'Samsat already added for this motor.');
            }

        // Create a new Samsat model with the car ID, old samsat value, and kode_samsat value
        Samsat::create([
            'motor_id' => $motor->id,
            'old_samsat' => $motor->samsat,
            'code_samsat' => $code_samsat,
        ]);

        if (!auth()->check()) {
            return redirect('sign-in')->with('success', 'Car samsat succesfully added, please sign in to continue');
        }
        // Redirect the user with a success message
        return redirect('samsatmotor')->with('success', 'Motor samsat succesfully added.');
    }
}
