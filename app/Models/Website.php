<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = ['link'];
    public $timestamps = true;

    public function subscribers() {
        return $this->
        belongsToMany(User::class, 'subscribes', 'website_id', 'subscriber_id')->withTimestamps();
    }

}
