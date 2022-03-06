<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSection extends Model
{
    use HasFactory;

    public function image()
    {
        return $this->morphMany(WorkoutImage::class,"imageable");
    }
}
