<?php
namespace Pebblemark\Profile\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Profile extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function userData()
    {
        $data = Profile::Where('user_id', Auth::user()->id)->get();
        $profile = array();
        foreach ($data as $d) {
            $profile[$d->key] = $d->value;
        }
        return $profile;
    }

    public static function userDataUpdate($request)
    {
        $data = $request->except([
            '_token',
            '_method'
        ]);

        foreach ($data as $k => $v) {
            if ($k == 'full_name') {
                $user = User::find(Auth::user()->id);
                $user->name = $v;
                $user->update();
            } else {
                if ($k == 'profile_image') {
                    $file = $request->profile_image->getClientOriginalName();
                    $request->profile_image->storeAs('profile-image', $file);
                    $v = $file;
                }

                Profile::updateOrCreate([
                    'user_id' => Auth::user()->id,
                    'key' => $k
                ], [
                    'key' => $k,
                    'value' => $v
                ]);
            }
        }
    }

    public static function updatePassword($request)
    {
        $user = User::findOrFail(Auth::user()->id);

        if (Hash::check($request->current_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            $message = "Password changed";
        } else {
            $message = "Old password does not match";
        }
        return $message;
    }
}
