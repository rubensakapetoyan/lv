<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Subscribe extends Model
{
    protected $fillable = ['subscriber_id', 'website_id'];
    public $timestamps = true;

    public function getAllData()
    {
        return self::all();
    }

    public function subscribers()
    {
        return $this->hasMany(User::class, 'id', 'subscriber_id');
    }

    public function websites()
    {
        return $this->hasMany(Website::class, 'id', 'website_id');
    }

}
