<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Movie extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function favorite()
    {
        $user = Auth::user();

        return $this->users()->syncWithoutDetaching($user);
    }

    public function unfavorite()
    {
        $user = Auth::user();

        return $this->users()->detach($user);
    }
}
