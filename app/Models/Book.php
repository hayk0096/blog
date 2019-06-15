<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name',
        'avatar',
        'author_id'
    ];

    protected $table = 'books';

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
