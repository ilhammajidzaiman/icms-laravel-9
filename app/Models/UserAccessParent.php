<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAccessParent extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(UserMenuParent::class, 'user_menu_parent_id', 'id');
    }
}
