<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAccessChild extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(UserMenuChild::class, 'user_menu_child_id', 'id');
    }
}
