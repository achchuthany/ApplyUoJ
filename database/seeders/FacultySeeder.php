<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fa = new Faculty();
        $fa->name = "Faculty of Agriculture";
        $fa->abbreviation = "AGRI";
        $fa->save();

        $fa = new Faculty();
        $fa->name = "Faculty of Arts";
        $fa->abbreviation = "ARTS";
        $fa->save();

        $fa = new Faculty();
        $fa->name = "Faculty of Engineering";
        $fa->abbreviation = "ENG";
        $fa->save();

        $fa = new Faculty();
        $fa->name = "Faculty of Management Studies and Commerce";
        $fa->abbreviation = "MACO";
        $fa->save();


        $fa = new Faculty();
        $fa->name = "Faculty of Medicine";
        $fa->abbreviation = "MED";
        $fa->save();


        $fa = new Faculty();
        $fa->name = "Faculty of Science";
        $fa->abbreviation = "SCI";
        $fa->save();


        $fa = new Faculty();
        $fa->name = "Faculty of Technology";
        $fa->abbreviation = "TECH";
        $fa->save();

    }
}
