<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.user.user-profile');
    }

    public function indexcus()
    {
        return view('welcome.customer-profile');
    }
    
    public function create()
    {
        return view('pages.user.profile');
    }

    public function update(Request $request)
    {
        $user = request()->user();
        // if(request()->file('image')){
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     $newName = $user->username.'-'.now()->timestamp.'.'.$extension;
        //     $request->file('image')->storeAs('profile', $newName);
        //     $request['gambar'] = $newName;
        // }
        
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'username' => 'required',
            'password' => 'nullable|regex:/[A-Z]/',
            'phone' => 'required|max:13',
            'address' => 'required',          
        ]);

        auth()->user()->update($attributes);
        return back()->with('success', 'Profile succesfully updated.');
    
}
public function updatecus(Request $request)
{
    $user = request()->user();
    // if(request()->file('image')){
    //     $extension = $request->file('image')->getClientOriginalExtension();
    //     $newName = $user->username.'-'.now()->timestamp.'.'.$extension;
    //     $request->file('image')->storeAs('profile', $newName);
    //     $request['gambar'] = $newName;
    // }
    
    $attributes = request()->validate([
        'email' => 'required|email|unique:users,email,'.$user->id,
        'username' => 'required',
        'password' => 'nullable|regex:/[A-Z]/',
        'phone' => 'required|max:13',
        'address' => 'required',          
    ]);

    auth()->user()->update($attributes);
    return back()->with('success', 'Profile succesfully updated.');

}
public function updatepassword(Request $request)
{
    $user = request()->user();
    $passEncrypt = Hash::make($request->password);
        if ($request->input('password')) {
            $attributes['password'] = $passEncrypt;
        }
        $attributes = request()->validate([
            'password' => 'required|regex:/[A-Z]/',        
        ]);

        auth()->user()->update($attributes);
        return back()->with('success', 'Password succesfully changed.');
}
public function updatepasswordcus(Request $request)
{
    $user = request()->user();
    $passEncrypt = Hash::make($request->password);
        if ($request->input('password')) {
            $attributes['password'] = $passEncrypt;
        }
        $attributes = request()->validate([
            'password' => 'required|regex:/[A-Z]/',        
        ]);

        auth()->user()->update($attributes);
        return back()->with('success', 'Password succesfully changed.');
}
}
