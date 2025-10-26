<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $fillable = ['item_id','disk','path','mime_type','size_bytes','kind'];
    public function item(){ return $this->belongsTo(Item::class); }
    public function getUrlAttribute(){ return Storage::disk($this->disk)->url($this->path); }
}
