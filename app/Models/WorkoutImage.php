<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WorkoutImage extends Model
{
    use HasFactory;

    public static $disc = '/workouts/';

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getPath()
    {
        return '/storage' . $this->path;
    }

    public static function uploadImage($file, $section)
    {
        $path = self::$disc . $file->hashName();
        Storage::disk('public')->put(self::$disc, $file);
        $workoutImage = new self();
        $workoutImage->path = $path;
        $workoutImage->imageable()->associate($section);
        $workoutImage->save();
    }
}
