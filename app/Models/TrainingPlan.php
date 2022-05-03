<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPlan extends Model
{
    protected $with = ['user','trainings'];
    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ["user_id","title","active_from","active_to","active"];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}
