<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaFile extends Model
{
    protected $fillable = [
        'item_id',
        'disk',
        'path',
        'mime_type',
        'size_bytes',
        'kind',
    ];

    // Relationship
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Computed attribute for file URL
    public function getUrlAttribute()
    {
        // Use public disk if none specified
        $disk = $this->disk ?? 'public';
        return Storage::disk($disk)->url($this->path);
    }
}
