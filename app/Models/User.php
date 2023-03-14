<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable , InteractsWithMedia;

    protected $visible = ['id', 'name', 'email'];

    protected $fillable = [
        'name', 'lastname', 'email', 'birthday', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPersonalPhoto(): Media
    {
        return $this->getFirstMedia('profile_photo');
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(UserGroup::class, 'users_groups');
    }

    public function inGroup($group): bool
    {
        return (bool) $this->groups->where('slug', $group)->count();
    }

    public function isAdmin(): bool
    {
        return (bool) $this->groups->where('slug', 'admin')->count();
    }
}
