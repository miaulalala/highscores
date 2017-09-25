<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Highscore extends Model
{
    protected $fillable = ['fname', 'lname', 'd_id', 'score', 'approved'];
    
    protected $hidden = ['created_at', 'updated_at', 'approved', 'id', 'd_id'];
    
    public function difficulty()
    {
        return $this->hasOne('App\Difficulty', 'd_id', 'd_id');
    }
}
