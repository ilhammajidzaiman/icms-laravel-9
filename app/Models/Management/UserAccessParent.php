<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Model;
use App\Models\Management\UserMenuParent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAccessParent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(UserMenuParent::class, 'user_menu_parent_id', 'id');
    }
}
