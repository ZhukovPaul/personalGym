<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WorkoutImage extends Model
{
    use HasFactory;

    static $disc = "/sections/"; 
    public function imageable()
    {
        return $this->morphTo();        
    }

    public function delete()
    {
        Storage::delete($this->path);
        return $this->delete();
    }

    static function uploadImage($file, $section)
    {
        $uploadPicture = $file;
        $path = self::$disc.$uploadPicture->hashName() ;
        \Illuminate\Support\Facades\Storage::put( self::$disc , $uploadPicture); 
        $workoutImage = new WorkoutImage();
        $workoutImage->path = $path;
        $workoutImage->imageable()->associate($section);
        $workoutImage->save();
    }
}
