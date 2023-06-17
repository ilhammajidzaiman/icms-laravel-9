<?php

namespace App\Models\NavMenu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NavMenuChild extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function parent()
    {
        return $this->hasOne(NavMenuParent::class, 'id', 'nav_menu_parent_id');
    }
}
