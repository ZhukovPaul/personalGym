<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @method static where(string $string, $workout)
 */
class Workout extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'difficulty', 'workout_section_id'];

    protected $hidden = ['created_at', 'updated_at', 'difficulty', 'type_workout_id', 'description'];

    public static function booted()
    {
        /* static::updated(function ($workout){
             $row = $workout->title  . " (" . $workout->section->title.')';
             Storage::disk('public')->append("system.log",$row);
         });*/
    }

    public function section()
    {
        return $this->belongsTo(WorkoutSection::class);
    }
}
