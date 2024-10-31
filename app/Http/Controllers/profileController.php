<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class profileController extends Controller
{
    // public function show()
    // {
    //     $user = Auth::user(); // Get the currently authenticated user

    //     // Fetch the user's recipes
    //     $recipes = Recipe::where('user_id', $user->id)->get();

    //     // Fetch the user's profile (adjust as per your schema)
    //     $profile = $user->profile; // This will return the profile associated with the user

    //     return view('profile.show', compact('user', 'recipes', 'profile')); // Pass the profile, recipes, and user to the view
    // }

    public function showProfile($id)
    {
        $user = User::findOrFail($id);
        // dd($user);
        $profile = $user->profile; // Assuming there's a relation to a Profile model
        // Eager load recipes along with their favorite count
        $recipes = Recipe::where('user_id', $user->id)
            ->withCount('favorites', 'reviews') // This will load the count of favorites for each recipe
            ->get();
        return view('profile.show', compact('user', 'profile', 'recipes'));
    }
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;

        // Use withCount to get the favorites count
        // Eager load the favorites count
        $recipes = Recipe::withCount('favorites', 'reviews')->where('user_id', $user->id)->get();

        if ($profile) {
            return view('profile.show', compact('profile', 'recipes', 'user'));
        } else {
            return view('profile.show', compact('profile', 'recipes', 'user'));
        }
    }

    public function create()
    {
        return view('profile.create');
    }

    public function store(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the request inputs
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:profiles',
                'bio' => 'nullable|string',
                'profile_picture' => 'nullable|image|max:2048',
            ]);

            $profilePicturePath = null;

            // If the request has a profile picture, store it
            if ($request->hasFile('profile_picture')) {
                $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            }

            // Create the profile in the database
            Profile::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'bio' => $request->bio,
                'profile_picture' => $profilePicturePath,
            ]);

            // If everything is okay, commit the transaction
            DB::commit();

            return redirect()->route('profile.index')->with('success', 'Profile created successfully!');
        } catch (\Throwable $th) {
            // If there's an error, rollback the transaction
            DB::rollback();

            return redirect()->back()->with('error', 'An error occurred while creating the profile. Please try again.');
        }
    }

    // Show the edit profile form
    public function edit()
    {
        $profile = Auth::user()->profile;

        return view('profile.edit', compact('profile'));
    }

    // Update the profile
    public function update(Request $request, $id)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the request inputs
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'bio' => 'nullable|string',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $profile = Auth::user()->profile;

            // Update profile details
            $profile->name = $request->name;
            $profile->email = $request->email;
            $profile->bio = $request->bio;

            // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {
                // Delete the old profile picture if it exists
                if ($profile->profile_picture) {
                    Storage::disk('public')->delete($profile->profile_picture);
                }

                // Store the new profile picture
                $profile->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
            }

            // Save the updated profile
            $profile->save();

            // Commit the transaction if successful
            DB::commit();

            return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
        } catch (\Throwable $th) {
            // Rollback the transaction in case of error
            DB::rollback();

            return redirect()->back()->with('error', 'An error occurred while updating the profile. Please try again.');
        }
    }
    /**
     * Handle the password change request.
     */
    public function changePassword(Request $request)
    {
        // Step 1: Validate the input
        $request->validate([
            'current_password' => 'required',        // User must provide the current password
            'new_password' => 'required|min:4|confirmed', // New password must be at least 8 characters and match confirmation
        ]);

        // Step 2: Check if the current password is correct
        $currentPassword = $request->current_password;   // Get current password from the request
        $userPassword = Auth::user()->password;          // Get current user's hashed password from the database

        if (!Hash::check($currentPassword, $userPassword)) {
            // If current password doesn't match, send back an error
            return back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        User::whare('id', Auth::user()->id)->update(['passowrd' => Hash::make($request->new_password)]);                                    // Save the updated password to the database

        // Step 4: Send a success message
        return back()->with('success', 'Password updated successfully!');
    }
    public function indexprofile()
    {
        // Fetch all profiles with the related user
        $profiles = Profile::with('user')->get();
        return view('users.all_profile', compact('profiles'));
    }
    // Add this method in your profileController

    public function accountInfo()
    {
        $user = Auth::user(); // Get the currently authenticated user
        $profile = $user->profile; // Fetch the user's profile

        return view('profile.account_info', compact('user', 'profile'));
    }
    // Delete the profile
    public function destroy($id)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            $profile = Profile::findOrFail($id); // Fetch the profile using the provided ID

            // If the profile has a picture, delete it from storage
            if ($profile->profile_picture) {
                Storage::disk('public')->delete($profile->profile_picture);
            }

            // Delete the profile from the database
            $profile->delete();

            // Commit the transaction if successful
            DB::commit();

            return redirect()->route('profile.index')->with('success', 'Profile deleted successfully!');
        } catch (\Throwable $th) {
            // Rollback the transaction in case of error
            DB::rollback();

            return redirect()->back()->with('error', 'An error occurred while deleting the profile. Please try again.');
        }
    }
}
