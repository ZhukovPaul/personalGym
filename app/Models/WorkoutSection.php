<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSection extends Model
{
    use HasFactory;

    protected $fillable = ["title","slug","description","workout_section_id"];

    /*public function __construct( array $attributes = array() ) {
        // mandatory
        parent::__construct($attributes);
    
        //..
    }*/
    /*
    static function workouts()
    {
         
    }
    */

    public function image()
    {
        return $this->morphOne(WorkoutImage::class,"imageable");
    }

    public function section()
    {
        return $this->belongsTo(WorkoutSection::class,"workout_section_id","id");
    }
     
   
}
