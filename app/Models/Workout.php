<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = ["title","slug","description","difficulty","workout_section_id"];
    protected $hidden = ["created_at","updated_at","difficulty","type_workout_id","description"];

    public static function booted()
    {
        /* static::updated(function ($workout){
             $row = $workout->title  . " (" . $workout->section->title.')';
             Storage::disk('public')->append("system.log",$row);
         });*/
    }

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
