<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'description',
        'genre',
        'acquired_on',
    ];

    public function container() {
        return $this->belongsTo('App\Models\Novel');
    }
}
