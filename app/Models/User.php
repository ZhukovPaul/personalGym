<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create(array $array)
 */
class User extends Authenticatable implements HasMedia
{
    use HasRoles,
        HasFactory,
        Notifiable ,
        InteractsWithMedia;

    protected $visible = ['id', 'name', 'email', 'vk_id'];

    protected $fillable = [
        'name', 'lastname', 'email', 'birthday', 'password', 'vk_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPersonalPhoto(): ?Media
    {
        return $this->getFirstMedia('profile_photo');
    }

    public function isAdmin(): bool
    {
        return true;
    }
}
