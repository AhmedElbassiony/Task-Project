<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class resetPasswordController extends Controller
{


    public function validateEmail(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        return api_response(true, 'validated email', null);
    }



    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required|min:6',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'same:password'
        ]);

        if (Hash::check($request->current_password, auth()->user()->password)) {
            try {
                DB::transaction(function () use ($request) {
                    auth()->user()->update([
                        'password' => Hash::make($request->password),
                    ]);
                    auth()->user()->tokens()->delete();
                });
            } catch (\Exception $e) {
                return api_response(false, 'Connection error!', null, 400);
            }
        } else {
            return api_response(false, 'Error password not match with old password.', null, 422);
        }
        return api_response(true, 'reset password successfully', new UserResource(auth()->user()));
    }

    public function sendResetLinkEmail(Request $request)
    {

        $data = $request->validate(
            [
                'email' => 'required|email'
            ]
        );


        $email = $data['email'];

        $user = User::where('email', $email)->first();

        $token = Crypt::encrypt($user->id);

        Mail::to($email)->send(new PasswordResetMail($token));

        return api_response(true, 'Reset link sent successfully', null);
    }

    public function resetForm($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function resetPassword(Request $request)
    {

        $data = $request->validate([
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'same:password',
            'token' => 'required',
        ]);
        $user = User::find(Crypt::decrypt($data['token']));
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'Password reset successfully!'], 200);
    }
}
