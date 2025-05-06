<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'description', 'trailer_url', 'duration', 'poster', 'status'
    ];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    //
}
