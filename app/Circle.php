<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    protected $fillable = ['name', 'image_name'];
    
    // state
    const STATE_NONE    = 0;
    const STATE_REQUEST = 1;
    const STATE_REFUSE  = 2;
    const STATE_JOIN    = 3;
    
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('state')->withTimestamps();
    }

    public function request_users()
    {
        return $this->users()->where('state', 0);
    }
}
