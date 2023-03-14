<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSection extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'workout_section_id'];

    public function section()
    {
        return $this->belongsTo(self::class, 'workout_section_id', 'id');
    }

    public function sections()
    {
        return $this->hasMany(self::class);
    }

    public function workouts()
    {
        return $this->hasMany(Workout::class);
    }
}
