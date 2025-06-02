<?php

namespace App\Models\Post;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'blog_article_id',
        'blog_tag_id',
    ];

    // protected $hidden = [
    //     'uuid',
    // ];

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         $model->uuid = Str::uuid();
    //     });
    // }

    public function article()
    {
        return $this->belongsTo(BlogArticle::class, 'blog_article_id', 'id');
    }

    public function tag()
    {
        return $this->belongsTo(BlogTag::class, 'blog_tag_id', 'id');
    }
}
