<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;
    public function enrolls(){
        return $this->hasMany('App\Models\Enroll');
    }

    public function application_registrations(){
        return $this->hasMany('App\Models\ApplicationRegistration');
    }
}
