<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutVideo extends Model
{

    protected $fillable = ["src","workout_id"];

    use HasFactory;

    public function videoable()
    {
        return $this->belongsTo(Workout::class);        
    }
}
