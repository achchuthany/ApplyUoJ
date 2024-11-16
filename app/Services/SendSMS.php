<?php

namespace App\Services;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SendSMS{
    public function send($receiver_phone_number,$message){
       return  Http::post('https://msmsenterpriseapi.mobitel.lk/EnterpriseSMSV3/esmsproxyURL.php', [
            "username" => config('app.sms_gateway.username'),
            "password" => config('app.sms_gateway.password'),
            "from" => config('app.sms_gateway.alias'),
            "to" => $receiver_phone_number,
            "text" =>  $message,
            "mesageType" => 0
        ]);
    }


    public function sentOTP($key): bool
    {
        try {
            $otp = random_int(100000, 999999);
            $valid_until = now()->addMinutes(5);
            $message = "MyUoJ: Your requested OTP is " . $otp . " on " . now()->toDayDateTimeString() .
                '. This OTP will be valid for five minutes. Please do not share this OTP with anyone';
            $sms = new SendSMS();
            $phone_number = auth()->user()->phone_number;
            $sms->send($phone_number, $message);
            Cache::tags(['users', $phone_number])->put($key, $otp, $valid_until);
        }catch (\Exception $e){
            return false;
        }
        return true;
    }

    public function validateOTP($key,$otp): bool
    {
        $phone_number = auth()->user()->phone_number;
        $cache_otp = Cache::tags(['users', $phone_number])->get($key, 'default');
        return $otp===$cache_otp;
    }
}
