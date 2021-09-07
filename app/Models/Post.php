<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'website_id', 'user_id'];

    public function getUser() {
        return $this->belongsTo('App\Models\User');
    }
}
