<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    public function subscribers() {
        return $this->belongsToMany('User');
    }
}
