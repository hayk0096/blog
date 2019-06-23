<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'full_name',
        'avatar',
        'user_id',
        'bio'
    ];

    protected $table = 'authors';

    public function books()
    {
        return $this->hasMany(Book::class);
    }

}
