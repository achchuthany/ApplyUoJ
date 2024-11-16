<?php

namespace App\Services;

use App\Jobs\SendSmsJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JobScheduleService{

    public function getSchedule(){
        $schedule = DB::table('job_schedule')->first();
        if($schedule && Carbon::parse($schedule->sms_scheduled_at)->lessThanOrEqualTo(Carbon::now())){
            DB::table('job_schedule')->update([
                'sms_scheduled_at'=>Carbon::now()->addSeconds(15),
                'updated_at'=>Carbon::now()
            ]);
        }
        if($schedule && Carbon::parse($schedule->email_scheduled_at)->lessThanOrEqualTo(Carbon::now())){
            DB::table('job_schedule')->update([
                'email_scheduled_at'=>Carbon::now()->addSeconds(30),
                'updated_at'=>Carbon::now()
            ]);
        }
        if(!$schedule){
            DB::table('job_schedule')->insert([
                'sms_scheduled_at'=>Carbon::now(),
                'email_scheduled_at'=>Carbon::now(),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
        }
        return DB::table('job_schedule')->first();
    }

    public function updateSchedule($email_scheduled_at,$sms_scheduled_at){
        DB::table('job_schedule')->update([
            'sms_scheduled_at'=>$sms_scheduled_at,
            'email_scheduled_at'=>$email_scheduled_at,
            'updated_at'=>Carbon::now()
        ]);
    }
}
