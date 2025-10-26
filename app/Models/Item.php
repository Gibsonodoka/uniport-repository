<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'title','abstract','year','type','course_code','supervisor','category_id','created_by','status'
    ];

    public function category() { return $this->belongsTo(Category::class); }
    public function media() { return $this->hasMany(MediaFile::class); }
    public function people() { return $this->belongsToMany(Person::class)->withPivot('role')->withTimestamps(); }

    // scopes for filtering
    public function scopePublished($q){ return $q->where('status','published'); }
    public function scopeType($q,$type){ return $q->where('type',$type); }
}

