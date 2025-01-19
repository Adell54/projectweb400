<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function purchaseHistory()
    {
        // Return the dummy data view
        return view('profile.history');
    }
    
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        if ($request->type === 'email') {
            // Validate and update email
            $request->validate([
                'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            ]);
    
            $user->email = $request->email;
            $user->email_verified_at = null; // Mark email as unverified if changed
            $user->save();
    
            return Redirect::route('profile.edit')->with('status', 'Email updated successfully!');
        }
    
        if ($request->type === 'password') {
            // Validate and update password
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'confirmed', 'min:8'],
            ]);
    
            $user->password = bcrypt($request->password);
            $user->save();
    
            return Redirect::route('profile.edit')->with('status', 'Password updated successfully!');
        }
    
        return Redirect::route('profile.edit')->with('status', 'No changes made.');
    }
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
