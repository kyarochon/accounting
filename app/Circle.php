<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    protected $fillable = ['name', 'image_name'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('state')->withTimestamps();
    }

    public function request_users()
    {
        return $this->users()->where('state', 0);
    }
    
}
