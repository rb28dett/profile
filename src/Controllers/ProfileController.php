<?php

namespace RB28DETT\Profile\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RB28DETT\Users\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the logged in user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicProfile()
    {
        return view('rb28dett_profile::public.profile', ['user' => User::findOrFail(Auth::id())]);
    }

    /**
     * Display a public form to edit the logged in user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicEditProfile()
    {
        return view('rb28dett_profile::public.edit', ['user' => User::findOrFail(Auth::id())]);
    }

    /**
     * Update profile from public form and return the public profile view.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function publicUpdateProfile(Request $request)
    {
        $notValid = $this->mainUpdateProfile($request);
        //  If $notValid it's true, something fail and then it should be corrected by user
        //  If $notValid is false, profile is updated ok

        if ($notValid) {
            // Validation or update fails
            return redirect()->route('rb28dett_public::profile.edit')->with('error', $notValid);
        }

        return redirect()->route('rb28dett_public::profile.index')->with('success', __('rb28dett_profile::general.profile_updated'));
    }

    /**
     * Display the logged in user's profile in rb28dett administration.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('rb28dett_profile::rb28dett.profile', ['user' => User::findOrFail(Auth::id())]);
    }

    /**
     * Display a form to edit the logged in user's profile in rb28dett administrations.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        return view('rb28dett_profile::rb28dett.edit', ['user' => User::findOrFail(Auth::id())]);
    }

    /**
     *  Update profile from rb28dett administration form and return the profile view of rb28dett administration.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $notValid = $this->mainUpdateProfile($request);
        //  If $notValid it's true, something fail and then it should be corrected by user
        //  If $notValid is false, profile is updated ok

        if ($notValid) {
            // Validation or update fails
            return redirect()->route('rb28dett::profile.edit')->with('error', $notValid);
        }
        // If it's here, validation has been success
        return redirect()->route('rb28dett::profile.index')->with('success', __('rb28dett_profile::general.profile_updated'));
    }

    /**
     * Validate public and private forms indifferently, and update info if validations are OK.
     *
     * @param \Illuminate\Http\Request $request
     */
    private function mainUpdateProfile($request)
    {
        $this->validate($request, [
            'name'              => 'required|min:3|max:191',
            'current_password'  => 'required',
        ]);

        $user = User::findOrFail(Auth::id()); // To use RB28DETT user model

        if (!Hash::check($request->current_password, $user->password)) {
            // Password incorrect
            return __('rb28dett_profile::general.incorrect_password'); // Update error: incorrect password
        }
        if ($request->hasFile('picture')) {
            $this->validate($request, [
                'picture' => 'image|max:5120',
            ]);

            if ($request->file('picture')->isValid()) {
                $request->file('picture')->move(public_path('/avatars'), md5($user->email));
            } else {
                return __('rb28dett_profile::general.image_not_valid'); // Update error: image not valid
            }
        } else {
            if ($user->hasAvatar()) {
                if (!$request->save_picture) {
                    File::delete(public_path('/avatars/'.md5($user->email)));
                }
            }
        }
        if ($request->password) {
            $this->validate($request, [
                'password' => 'min:6|confirmed',
            ]);
            $user->update(['password' => $request->password]);
        }

        if ($request->name) {
            $user->update(['name' => $request->name]);
        }

        return 0; // Updated completed okai
    }
}
