<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationRegistration extends Model
{
    use HasFactory;
    public function academic_year(){
        return $this->belongsTo('App\Models\AcademicYear');
    }
    public function programme(){
        return $this->belongsTo('App\Models\Programme');
    }
}
