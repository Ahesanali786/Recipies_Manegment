<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    function register(Request $request)
    {

        try {
            DB::beginTransaction();


            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $user->save();
            DB::commit();
            return redirect('login')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to register user');
        }
    }
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Check if user is blocked
            if ($user->is_blocked) {
                return redirect()->back()->with('error', 'Your account has been blocked. Please contact support.');
            }

            // Check if password is correct
            if (Hash::check($request->password, $user->password)) {
                // Log in the user
                Auth::login($user);

                return redirect('home');
            } else {
                return redirect()->back()->with('error', 'Invalid Credential');
            }
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }

    function logout()
    {

        Auth::logout();
        return redirect('login');
    }
}
