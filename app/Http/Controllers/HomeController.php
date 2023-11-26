<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        return view('profile');
    }

    public function profilePost(Request $request)
    {
        $request->validate([
            'profile_name' => ['required'],
            'mobile_phone_number' => ['required'],
            'email' => ['required', 'email'],
        ]);

        User::find(auth()->user()->id)->update([
            'name' => $request->profile_name,
            'email' => $request->email,
            'phone' => $request->mobile_phone_number
        ]);

        return redirect()->route('profile')->with('success', 'You have successfully update your profile.');
    }
}
