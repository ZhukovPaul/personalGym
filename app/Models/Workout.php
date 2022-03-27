<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = ["title","slug","description","difficulty","workout_section_id"];

    public function image()
    {
        return $this->morphOne(WorkoutImage::class, 'imageable');
    }

    public function video()
    {
        return $this->hasOne(WorkoutVideo::class);
    }

    public function section()
    {
        return $this->belongsTo(WorkoutSection::class);
    }
   
}
