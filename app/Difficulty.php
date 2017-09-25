<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
    protected $hidden = ['updated_at', 'created_at', 'd_id'];
}
