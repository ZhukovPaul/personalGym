<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $with =['workout','sets'];

    public $timestamps = false; 
    protected $fillable = ["sort","training_id","workout_id"];

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function sets()
    {
        return $this->hasMany(ExerciseSet::class);
    }
}
