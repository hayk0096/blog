<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'bio'
    ];

    protected $table = 'authors';

    public function books()
    {
        return $this->hasMany(Book::class, 'id', 'author_id');
    }

}
