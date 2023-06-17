<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMenuChild extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function parent()
    {
        return $this->hasOne(UserMenuParent::class, 'id', 'user_menu_parent_id');
    }

    public function access()
    {
        return $this->hasMany(UserAccessChild::class, 'user_menu_child_id', 'id');
    }
}
