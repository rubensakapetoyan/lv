<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = ['subscriber_id', 'website_id'];

    public function subscribers() {
        return $this->
        belongsToMany('App\Models\User','users', 'subscriber_id', 'website_id')->withTimestamps();
    }

    public function websites() {
        return $this->
        belongsToMany('App\Models\Website','websites', 'website_id', 'subscriber_id')->withTimestamps();
    }

}
