<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogArticle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        'user_id',
        'blog_category_id',
        'slug',
        'title',
        'content',
        'file',
        'description',
        'attachment',
        'visitor',
        'is_show',
        'published_at',
    ];

    protected $hidden = [
        'uuid',
    ];

    protected $casts = [
        'is_show' => 'boolean',
        'attachment' => 'array',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'ilike', '%' . $search . '%');
        });
        $query->when($filters['start_date'] ?? false, function ($query, $startDate) {
            return $query->whereDate('created_at', '>=', $startDate);
        });
        $query->when($filters['end_date'] ?? false, function ($query, $endDate) {
            return $query->whereDate('created_at', '<=', $endDate);
        });
        return $query;
    }

    public function scopeShow($query)
    {
        return $query->where('is_show', true);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_posts', 'blog_article_id', 'blog_tag_id')->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'blog_article_id', 'id');
    }

    public function modelable(): MorphOne
    {
        return $this->morphOne(NavMenu::class, 'modelable');
    }

    public function modelables(): MorphMany
    {
        return $this->morphMany(NavMenu::class, 'modelable');
    }
}
