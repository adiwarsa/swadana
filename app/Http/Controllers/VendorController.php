<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = Vendor::where('type' , '1')->get();
        return view('pages.vends.vendor', ['vendor' => $vendor]);
    }

    public function motorindex()
    {
        $vendor = Vendor::where('type' , '2')->get();
        return view('pages.vends.vendormotor', ['vendor' => $vendor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.vends.create');
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
            'name' => 'required|unique:vendors|max:255',
        ]);
        Vendor::create([
            'name' => $request->name,
            'type' => '1',
        ]);
        return redirect()->back()->with('success', 'Vendor successfully added');
    }

    public function storemotor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:vendors|max:255',
        ]);
        Vendor::create([
            'name' => $request->name,
            'type' => '2',
        ]);
        return redirect()->back()->with('success', 'Vendor successfully added');
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
    public function edit($slug)
    {
        $vendor = Vendor::where('slug', $slug)->first();
        return view('pages.vends.edit', ['vendor' => $vendor]);
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
        $validated = $request->validate([
            'name' => 'required|unique:vendors|max:255',
        ]);

        $vendor = Vendor::where('slug', $slug)->first();
        $vendor->slug = null;
        $vendor->update($request->all());
        return redirect()->back()->with('success', 'Vendor successfully changed');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $vendor = Vendor::where('slug', $slug)->first();
        $vendor->delete();
        return redirect('vendors')->with('success', 'Vendor successfully deleted');

    }
}
