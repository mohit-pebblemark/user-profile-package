<?php
namespace Pebblemark\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;
use Pebblemark\Profile\Http\Requests\ProfileFormRequest;
use Pebblemark\Profile\Models\Profile;
use Pebblemark\Profile\Http\Requests\PasswordResetFormRequest;

class ProfileController extends Controller
{

    public function profile()
    {
        $profile = Profile::userData();
        return view('profile::profile')->with('profile', $profile);
    }

    public function updateProfile(ProfileFormRequest $request)
    {
        Profile::userDataUpdate($request);
        return redirect()->route('profile')->with('message', 'Profile Updated!');
    }

    public function profileImage($image)
    {
        return response()->download(storage_path('app/profile-image/' . $image), null, [], null);
    }

    public function passwordUpdate(PasswordResetFormRequest $request)
    {
        Profile::updatePassword($request);
        return redirect()->route('profile')->with('message', 'Password changed!');
    }
}
