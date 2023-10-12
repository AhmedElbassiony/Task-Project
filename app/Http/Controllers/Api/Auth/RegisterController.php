<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function userRegisterValidation(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|digits:11|unique:users,mobile',
            'password' => 'required|min:6',
        ]);

        return api_response(
            true,
            'validated data',
            [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                'password' => $data['password'],
            ]
        );
    }

    public function emailRegister(Request $request)
    {
        $data = $request->validate([

            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);


       $this->sendOTP($data['email']);

        $password = bcrypt($request->password);

        try {
            $data_transactions = DB::transaction(function () use ($data, $password, $request) {
                $user = User::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'password' => $password,
                ]);

                $user->assignRole('user');
                return $user;
            });
        } catch (\Exception $e) {
            return api_response(false, 'connection error', null, 400);
        }

        return api_response(true, 'user added successfully', new UserResource($data_transactions));
    }


    public function mobileRegister(Request $request)
    {
        $data = $request->validate([

            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|digits:11|unique:users,mobile',
            'password' => 'required|min:6',
        ]);

        // $this->sendOTP($request);

        $password = bcrypt($request->password);

        try {
            $data_transactions = DB::transaction(function () use ($data, $password, $request) {
                $user = User::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'mobile' => $data['mobile'],
                    'password' => $password,
                    'verified' => true,
                ]);

                $user->assignRole('user');
                return $user;
            });
        } catch (\Exception $e) {
            return api_response(false, 'connection error', null, 400);
        }

        return api_response(true, 'user added successfully', new UserResource($data_transactions));
    }

   public function sendOTP( $email)
    {

        $userOtp = OtpMail::where('email', $email)->first();
        $code = random_int(10 ** (3), (10 ** 4) - 1);
        Mail::to($email)->send(new \App\Mail\OtpMail($code));
        if ($userOtp) {
            $userOtp->code = $code;
            $userOtp->save();
        } else {
            OtpMail::create([
                'email' => $email,
                'code'  => $code
            ]);
        }

        return api_response(true, 'code sent successfully', null);
    }

    public function verifyOTP(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:otp_mails,email',
            'code' => 'required|digits:4',
        ]);
        $userOtp = OtpMail::where('email', $data['email'])->first();
        $user = User::where('email', $data['email'])->first();

        if ($request->code != $userOtp->code) {
            return api_response(false, 'code is not valid!!', null, 403);
        }

        // OTP is valid
        $user->verified = true;
        $user->save();
        return api_response(true, 'Registration completed successfully', null);
    }
}
