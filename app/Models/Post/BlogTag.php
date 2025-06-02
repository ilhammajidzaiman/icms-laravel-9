<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogTag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'is_show'
    ];

    protected $hidden = [
        'uuid',
    ];

    protected $casts = [
        'is_show' => 'boolean',
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

    public function blogArticles(): BelongsToMany
    {
        return $this->belongsToMany(BlogArticle::class, 'blog_posts', 'blog_article_id', 'blog_tag_id')->withTimestamps();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'blog_tag_id', 'id');
    }
}
