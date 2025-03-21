<?php

namespace App\Console\Commands;

use App\Models\AcademicYear;
use App\Models\Enroll;
use App\Services\LuhnService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateEnrollTableWithPayerID extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enroll:generate-payer-id {academicYearName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Enroll Table with Payer ID';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        DB::beginTransaction();

        try {
            //make this as transaction
            $academicYearName = $this->argument('academicYearName');

            $academicYear = AcademicYear::where('name', $academicYearName)->first();
            if (!$academicYear) {
                $this->error('Academic Year not found!');
                return 0;
            }
            $newPayerId = $academicYear->next_payer_id;
            $lastTwoDigits = substr($academicYear->name, -2);
            $this->info('Starting the table update...' . $lastTwoDigits);


            $enrolls = Enroll::where('academic_year_id', $academicYear->id)->get();

            foreach ($enrolls as $enroll) {
                $payer_id = $lastTwoDigits . str_pad($newPayerId, 5, '0', STR_PAD_LEFT);
                $new_payer_id = LuhnService::generateCheckDigitPrepend($payer_id);
                $enroll->payer_id = $new_payer_id;
                $this->line('Processing Item ... ' . $enroll->reg_no . ' .... ' . $new_payer_id);
                $enroll->save();
                $newPayerId++;
            }

            //update the next payer id
            $academicYear->next_payer_id = $newPayerId;
            $academicYear->save();
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            $this->error('Error: ' . $e->getMessage());
            return 0;
        }
        return 1;
    }
}
