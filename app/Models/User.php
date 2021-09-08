<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];
    public $timestamps = true;


    public function websites() {
        return $this
            ->belongsToMany(Website::class, 'subscribes', 'subscriber_id', 'website_id')->withTimestamps();
    }
}
