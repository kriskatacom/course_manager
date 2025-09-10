<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "slug",
        "short_description",
        "description",
        "category_id",
        "level",
        "duration",
        "price",
        "is_free",
        "discount_price",
        "status",
        "meta",
        "published_at",
        "expires_at",
    ];

    protected $casts = [
        "is_free" => "boolean",
        "price" => "decimal:2",
        "discount_price" => "decimal:2",
        "meta" => "array",
        "published_at" => "datetime",
        "expires_at" => "datetime",
    ];

    public const STATUSES = [
        'draft',
        'published',
        'archived',
    ];

    public const STATUS_COLORS = [
        'draft' => 'bg-gray-600 text-gray-100',
        'published' => 'bg-green-600 text-gray-100',
        'archived' => 'bg-yellow-600 text-gray-100',
    ];

    public const STATUS_DRAFT     = "draft";
    public const STATUS_PUBLISHED = "published";
    public const STATUS_ARCHIVED  = "archived";

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
