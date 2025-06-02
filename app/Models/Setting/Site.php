<?php

namespace App\Models\Setting;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        'name',
        'email',
        'address',
        'phone',
        'map',
        'social_media',
        'favicon',
        'logo',
    ];

    protected $hidden = [
        'uuid',
    ];

    protected $casts = [
        'social_media' => 'array',
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
}
