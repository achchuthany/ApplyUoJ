<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    /**
     * @var mixed|string
     */
    private $abbreviation;
    /**
     * @var mixed|string
     */
    private $name;

    public function programmes(){
        return $this->hasMany('App\Models\Programme');
    }
}
