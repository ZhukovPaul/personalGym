<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = ["title","slug","description","difficulty","workout_section_id"];

    public function image()
    {
        return $this->morphOne(WorkoutImage::class, 'imageable');
    }

    public function videos()
    {
        return $this->hasMany(WorkoutVideo::class);
    }
   
}
