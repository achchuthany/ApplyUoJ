<?php

namespace App\Jobs;

use App\Models\AcademicYear;
use App\Models\ApplicationRegistration;
use App\Models\CsvData;
use App\Models\Programme;
use App\Models\Student;
use App\Services\JobScheduleService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class WelcomeEmailScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $programme_id,$academic_year_id,$csv_data_file_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($programme_id,$academic_year_id,$csv_data_file_id)
    {
        $this->programme_id = $programme_id;
        $this->academic_year_id = $academic_year_id;
        $this->csv_data_file_id = $csv_data_file_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Log::info('### WelcomeEmailScheduleJob started ###');
        $programme = Programme::where('id',$this->programme_id)->first();
        $academic_year = AcademicYear::where('id',$this->academic_year_id)->first();
        $applicationRegistration = ApplicationRegistration::where('programme_id',$this->programme_id)->where('academic_year_id',$this->academic_year_id)->first();
        $data = CsvData::find($this->csv_data_file_id);
        $csv_x = json_decode($data->csv_data, true);

        $academicYear = $academic_year->name;
        $programmeName = $programme->name;
        $facultyName = $programme->faculty->name;

        $closeDate = Carbon::parse($applicationRegistration->close_date)->toDayDateTimeString();
        $accountNumber = $applicationRegistration->account_number;
        $amount = $applicationRegistration->deposit_amount;

        //job
        $jobService = new JobScheduleService();
        $schedule = $jobService->getSchedule();
        $sms_scheduled_at = Carbon::parse($schedule->sms_scheduled_at);
        $email_scheduled_at = Carbon::parse($schedule->email_scheduled_at);

        $csv_data = array_slice($csv_x, 1);

        //schedule
        $gmail_schedule = config('app.gmail_schedule');
        $delay_bulk = $gmail_schedule['delay_bulk'];
        $limit = $gmail_schedule['limit'];
        $delay_one = $gmail_schedule['delay_one'];
        $count = 0;
        foreach ($csv_data as $row) {
            ($count>=$limit && $count%$limit==0) ? $scheduled_at = $delay_bulk : $scheduled_at = $delay_one;
            $count++;

            $student = Student::where('nic', $row[16])->first();
            $enroll = $student->enrolls()->latest()->first();
            $refNo = $enroll->getRefNo();
            $mobile = !empty($row[15]) ? substr($row[15], -9) : null;
            $email= $row[18];
            $mobileHome = !empty($row[19]) ? substr($row[19], -9) : null;
            $name= $row[3];
            //Log::info('Student'.$count,[$refNo,$name,$email,$programmeName,$academicYear,$facultyName,$accountNumber,$amount,$closeDate]);
            //sms job
            $message = "Welcome to the University of Jaffna! Complete your enrollment for the ".$programmeName." course before ".$closeDate.". Visit https://sis.jfn.ac.lk or check your email for details.";
            if($mobile && substr($mobile, 0, 1) == '7'){
                $job_sms = (new SendMessageJob($mobile, $message))
                    ->delay(
                        $sms_scheduled_at->addSecond()
                    );
                dispatch($job_sms);
                Log::info('Student'.$count,['SMS 1',$mobile]);
            }
            if($mobileHome && $mobile != $mobileHome && substr($mobileHome, 0, 1) == '7'){
                $job_sms = (new SendMessageJob($mobileHome, $message))
                    ->delay(
                        $sms_scheduled_at->addSecond()
                    );
                dispatch($job_sms);
                Log::info('Student'.$count,['SMS 2',$mobileHome]);
            }
            if ($email) {
                $job = (new WelcomeEmailJob($refNo,$name,$email,$programmeName,$academicYear,$facultyName,$accountNumber,$amount,$closeDate))
                    ->delay(
                        $email_scheduled_at->addSeconds($scheduled_at)
                    );
                dispatch($job);
                Log::info('Student'.$count,['Email',$email,$email_scheduled_at,$scheduled_at]);
            }

        }
        $jobService->updateSchedule($email_scheduled_at,$sms_scheduled_at);
        //Log::info('### WelcomeEmailScheduleJob end ###');
    }
}
