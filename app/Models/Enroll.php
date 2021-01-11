<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    use HasFactory;
    public function academic_year(){
        return $this->belongsTo('App\Models\AcademicYear');
    }
    public function student(){
        return $this->belongsTo('App\Models\Student');
    }
    public function programme(){
        return $this->belongsTo('App\Models\Programme');
    }

    public function getRefNo(){
        return '#'.$this->programme->abbreviation.''.sprintf('%04d', $this->id) ;
    }
}
