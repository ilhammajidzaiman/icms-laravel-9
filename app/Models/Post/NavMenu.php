<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Media\FileCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SolutionForest\FilamentTree\Concern\ModelTree;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NavMenu extends Model
{
    use HasFactory, SoftDeletes, ModelTree;

    protected $fillable = [
        'user_id',
        'parent_id',
        'modelable_type',
        'modelable_id',
        'order',
        'slug',
        'title',
        'is_show',
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

    public function determineOrderColumnName(): string
    {
        return 'order';
    }

    public function scopeShow($query)
    {
        return $query->where('is_show', true);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function modelable(): MorphTo
    {
        return $this->morphTo();
    }

    public function parent()
    {
        return $this->belongsTo(NavMenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(NavMenu::class, 'parent_id');
    }

    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class, 'modelable_id', 'id');
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'modelable_id', 'id');
    }

    public function blogArticle(): BelongsTo
    {
        return $this->belongsTo(BlogArticle::class, 'modelable_id', 'id');
    }

    public function blogCategory(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'modelable_id', 'id');
    }

    public function fileCategory(): BelongsTo
    {
        return $this->belongsTo(FileCategory::class, 'modelable_id', 'id');
    }
}
