<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMenuParent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function access()
    {
        return $this->hasMany(UserAccessParent::class, 'user_menu_parent_id', 'id');
    }
}
