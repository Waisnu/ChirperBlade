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


    public function updateTimezone(Request $request)
    {
        $request->validate([
            'timezone' => 'required|in:' . implode(',', array_keys(config('timezones.options'))),
        ]);

        $user = Auth::user();
        $newTimezone = $request->input('timezone');

        // Check if the timezone is actually changed
        if ($user->timezone !== $newTimezone) {
            $user->update(['timezone' => $newTimezone]);

            return redirect()->route('profile.edit')->with('status', 'timezone-updated');
        }

        // The timezone is not changed
        return redirect()->route('profile.edit')->with('status', 'timezone-not-updated');
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $timezones = config('timezones.options', [

        ]);

        return view('profile.edit', compact('user', 'timezones'));
    }


    /**
     * Update the user's profile information.
     */

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
