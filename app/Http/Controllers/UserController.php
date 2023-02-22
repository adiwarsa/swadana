<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('role_id','>', 1)->get();
        return view('pages.user.user-management', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('pages.user.create', ['role' => $role ]);
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
            'username' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255',
        ]);
        
        // $request['password'] = bcrypt($request->password);
        $newName= '';
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->username.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('profile', $newName);
        }

        $request['gambar'] = $newName;
        $user = User::create($request->all());
        return redirect('user')->with('success', 'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);
        return view('pages.user.detail', ['data' => $data ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $role = Role::all();
        return view('pages.user.edit',['user' => $user , 'role' => $role]);
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
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->username.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('profile', $newName);
            $request['gambar'] = $newName;
        }
       
        $user = User::where('id', $id)->first();
        $user->update($request->all());

        return redirect('user')->with('success', 'User successfully updated.');
    }

    public function updateStatus(Request $request, $id)
    {

        $user = User::where('id', $id)->first();

        $currenttime = Carbon::Now();
        $user->update([
            'status' => $request->status,
            'updated_at' => $currenttime,
        ]);
        return redirect('user')->with('success', 'User status successfully changed.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect('user')->with('success', 'User successfully deleted.');
    }
}
