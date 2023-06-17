<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMenuParent extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function access()
    {
        return $this->hasMany(UserAccessParent::class, 'user_menu_parent_id', 'id');
    }
}
