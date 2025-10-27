<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'abstract',
        'year',
        'type',
        'course_code',
        'supervisor',
        'category_id',
        'created_by',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function media()
    {
        return $this->hasMany(MediaFile::class);
    }

    public function people()
    {
        return $this->belongsToMany(Person::class)
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Published scope (for frontend visibility)
    public function scopePublished($query)
    {
        return $query->where('status', 'approved');
    }

    // Filter by type
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Filter by pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Filter by approved
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /*
    |--------------------------------------------------------------------------
    | Model Events
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            // Automatically assign the creator (if logged in)
            if (auth()->check()) {
                $item->created_by = auth()->id();
            }

            // Default status on new submission
            if (empty($item->status)) {
                $item->status = 'pending';
            }
        });
    }
}
