<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Model;
use App\Models\Management\UserMenuParent;
use App\Models\Management\UserAccessChild;
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
