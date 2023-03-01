<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\Samsat;
use App\Models\Vendor;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car = Car::with('vendors')->orderBy('status')->get();
        return view('pages.car.car', ['car' => $car]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor = Vendor::where('type', '1')->get();
        $categories = Category::where('type','1')->get();
        return view('pages.car.create', ['vendor' => $vendor , 'categories' => $categories]);
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
            'nama_mobil' => 'required|unique:cars|max:255',
        ]);

        $newName= '';
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->nama_mobil.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('gambar', $newName);
        }

        $request['gambar'] = $newName;
        $remind = 0;
        $car = Car::create($request->all() + ['remind' => $remind]);
        $car->categories()->sync($request->categories);
        return redirect('car')->with('success', 'Car successfully added.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Car::find($id);
        return view('pages.car.detail', ['data' => $data ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $car = Car::where('slug', $slug)->first();
        $vendor = Vendor::all();
        $categories = Category::all();
        return view('pages.car.edit',['vendor' => $vendor , 'categories' => $categories, 'car' => $car]);
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
       
        $car = Car::where('slug', $slug)->first();
        $car->update($request->all());

        if($request->categories){
            $car->categories()->sync($request->categories);
        }
        return redirect('car')->with('success', 'Car successfully changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $car = Car::where('slug', $slug)->first();
        $car->delete();
        return redirect('car')->with('success', 'Car successfully deleted.');
    }

    public function updateStatusAndCreateSamsat($id)
    {
        // $car = Car::findOrFail($id);
        // $car->remind = 1;
        // $car->save();
    
        // Samsat::create([
        //     'car_id' => $car->id,
        //     'old_samsat' => $car->samsat,
        // ]);
    

        // Find the car with the specified ID or throw an exception if it doesn't exist
        $car = Car::findOrFail($id);

        // Update the remind field of the car model
        $car->remind = 1;
        $car->save();

        // Generate the kode_samsat value using the car name and current date
        $car_name = $car->nama_mobil;
        $car_name_length = strlen($car_name);
        $code_samsat = strtoupper(substr($car_name, 0, 1) // First letter of car name
            . substr($car_name, (int) ($car_name_length / 2), 1) // Middle letter of car name
            . substr($car_name, -1) // Last letter of car name
            . '-' . date('Ymd')); // Current date in Ymd format

            // Check if the kode_samsat value already exists
            $existing_samsat = Samsat::where('code_samsat', $code_samsat)->first();
            if ($existing_samsat) {
            // Return an error message if the kode_samsat value already exists
                return redirect('sign-in')->withError([
                    'samsat' => 'Samsat already submitted for this car!'
                ]);
            }

        // Create a new Samsat model with the car ID, old samsat value, and kode_samsat value
        Samsat::create([
            'car_id' => $car->id,
            'old_samsat' => $car->samsat,
            'code_samsat' => $code_samsat,
        ]);

        if (!auth()->check()) {
            return redirect('sign-in')->with('success', 'Car samsat succesfully added, please sign in to continue');
        }
        // Redirect the user with a success message
        return redirect('samsat')->with('success', 'Car samsat succesfully added.');
    }

    // public function updateStatusAndCreateSamsat($id)
    // {
    //     FacadesSession::forget('button_clicked');
    // // Check if the action has already been performed
    // if (session()->has('button_clicked') && session()->get('button_clicked') === true) {
    //     // Return an error message or redirect the user
    //     return redirect('sign-in')->withErrors(['The action has already been clicked.']);
    // }

    // // Perform the action
    // $car = Car::findOrFail($id);
    // $car->remind = 1;
    // $car->save();

    // Samsat::create([
    //     'car_id' => $car->id,
    //     'old_samsat' => $car->samsat,
    // ]);

    // // Set the session variable to remember that the action has been performed
    // session()->put('button_clicked', true);

    // return redirect('sign-in')->withStatus(['Car Samsat successfully added.']);
    // }

}
