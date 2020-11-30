<?php

namespace Domain\Users;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Domain\Shared\Traits\HasUuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Domain\Movies\Movie;
use Illuminate\Database\Eloquent\Relations\Pivot;

class User extends Authenticatable implements JWTSubject
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function bookmarks()
    {
        return $this->belongsToMany(Movie::class, 'movie_user', 'user_id', 'movie_id')
            ->using(new class extends Pivot {
                use HasUuid;
            })
            ->withTimestamps()
            ->whereNull('movie_user.deleted_at');
    }
}
