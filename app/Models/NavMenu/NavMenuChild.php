<?php

namespace App\Models\NavMenu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavMenuChild extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function parent()
    {
        return $this->hasOne(NavMenuParent::class, 'id', 'nav_menu_parent_id');
    }
}
