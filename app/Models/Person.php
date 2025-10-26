<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['name','email','affiliation'];
    public function items(){ return $this->belongsToMany(Item::class)->withPivot('role')->withTimestamps(); }
}

