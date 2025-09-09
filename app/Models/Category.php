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
}
