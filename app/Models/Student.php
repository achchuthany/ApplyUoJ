<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public function addresses(){
        return $this->hasMany('App\Models\Address');
    }
    public function student_al_exams(){
        return $this->hasMany('App\Models\StudentAlExam');
    }
    public function enrolls(){
        return $this->hasMany('App\Models\Enroll');
    }
    public function users(){
        return $this->belongsToMany('App\Models\User', 'user_student', 'student_id', 'user_id');
    }
    public function student_docs(){
        return $this->hasMany('App\Models\StudentDoc');
    }
}
