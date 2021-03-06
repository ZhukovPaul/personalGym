<?php

namespace App\Models;

use App\Models\UserImage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /*
    public function __construct()
    {
        return Auth::user();   
    }
    */

    protected $visible = ["id","name","email"];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 'lastname','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image()
    {
        return $this->belongsTo(UserImage::class,"user_image_id","id");
    }

 
    public function groups()
    {
        return $this->belongsToMany(UserGroup::class,"users_groups");
    }

    public function inGroup($group)
    {
        return (bool)$this->groups->where("slug",$group)->count();
    }

    public function isAdmin()
    {
       
        return (bool)$this->groups->where("slug","admin")->count();
    }
    
}
