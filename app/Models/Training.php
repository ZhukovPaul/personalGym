<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $with = ['exercises'];

    protected $visible = ['day_of_week', 'exercises', 'training_plan_id'];

    protected $fillable = ['title', 'training_plan_id', 'day_of_week'];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}
