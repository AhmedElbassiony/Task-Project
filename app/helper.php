<?php

use App\Models\OtpMail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



if (!function_exists('api_response')) {
    function api_response($status, $message, $data = null, $status_code = 200)
    {
        $response = [
            'status'   =>   $status,
            'message'  =>   $message,
            'data'      =>  $data
        ];
        $pagination =  api_model_set_pagenation($data);
        if ($pagination) $response['pagination'] = $pagination;
        return response()->json($response, $status_code);
    }
}


if (!function_exists('api_model_set_pagenation')) {

    function api_model_set_pagenation($model)
    {
        if (is_object($model)) {
            try {
                $pagnation['total'] = $model->total();
                $pagnation['lastPage'] = $model->lastPage();
                $pagnation['perPage'] = $model->perPage();
                $pagnation['currentPage'] = $model->currentPage();
                return $pagnation;
            } catch (\Exception $e) {
            }
        }
        return null;
    }
}


if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 2)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return response()->json(['data' => $randomString . rand(1000, 9999)]);
    }
}

// if (!function_exists('sendOTP')) {
//     function sendOTP( $email)
//     {
//         return $email;
//         $userOtp = OtpMail::where('email', $email)->first();
//         $code = random_int(10 ** (3), (10 ** 4) - 1);
//         Mail::to($email)->send(new \App\Mail\OtpMail($code));
//         if ($userOtp) {
//             $userOtp->code = $code;
//             $userOtp->save();
//         } else {
//             OtpMail::create([
//                 'email' => $email,
//                 'code'  => $code
//             ]);
//         }

//         return api_response(true, 'code sent successfully', null);
//     }
// }


