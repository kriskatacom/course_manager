<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "categories";

    protected $fillable = [
        "name",
        "slug",
        "description",
        "parent_id",
        "image",
        "status",
        "sort_order",
    ];

    public const STATUSES = [
        'draft',
        'published',
        'archived',
        'hidden',
        'pending',
    ];

    public const STATUS_COLORS = [
        'draft' => 'bg-gray-600 text-gray-100',
        'published' => 'bg-green-600 text-gray-100',
        'archived' => 'bg-yellow-600 text-yellow-100',
        'hidden' => 'bg-red-600 text-red-100',
        'pending' => 'bg-blue-600 text-blue-100',
    ];

    public const STATUS_DRAFT     = "draft";
    public const STATUS_PUBLISHED = "published";
    public const STATUS_ARCHIVED  = "archived";
    public const STATUS_HIDDEN    = "hidden";
    public const STATUS_PENDING   = "pending";

    public function parent()
    {
        return $this->belongsTo(Category::class, "parent_id");
    }

    public function children()
    {
        return $this->hasMany(Category::class, "parent_id");
    }

    public function scopePublished($query)
    {
        return $query->where("status", self::STATUS_PUBLISHED);
    }

    public function scopeDraft($query)
    {
        return $query->where("status", self::STATUS_DRAFT);
    }

    public function scopeArchived($query)
    {
        return $query->where("status", self::STATUS_ARCHIVED);
    }
    
    public function childrenRecursive()
    {
        return $this->hasMany(Category::class, 'parent_id')
                    ->with('childrenRecursive');
    }

    public function statusClasses(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'bg-gray-600 text-gray-100';
    }
}