<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;


    public function ninja(){
    	return $this->hasMany(Ninja::class);
    }

    public function employer(){
    	return $this->belongsTo(Employer::class);
    }

}
