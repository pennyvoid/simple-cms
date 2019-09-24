<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        return $this->middleware('mainAdmin')->only(['destroy', 'makeAdmin', 'makeWriter']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with('users', User::all());
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
    public function show(User $user)
    {
        return view('admin.users.show')->with('user', $user);
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
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('error', "User: {$user->name} deleted successfully");
        return redirect()->back();
    }
    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        session()->flash('success', "{$user->name} made admin successfully");
        return redirect()->back();
    }
    public function makeWriter(User $user)
    {
        $user->role = 'writer';
        $user->save();
        session()->flash('error', "{$user->name} made writer successfully");
        return redirect()->back();
    }
    public function editProfile()
    {
        return view('admin.users.edit')->with('user', Auth::user());
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'google' => 'required',
            'twitter' => 'required',
        ]);
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->storeAs(
                'profile',
                Carbon::now()->format('d-m-Y') . '@' . $request->file('avatar')->getClientOriginalName()
            );
            $user->avatar = $avatar;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->google = $request->google;
        $user->twitter = $request->twitter;
        $user->about = $request->about;
        if ($request->has('password') && !is_null($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        session()->flash('success', "Profile updated successfully");
        return redirect(route('dashboard'));
    }
}
