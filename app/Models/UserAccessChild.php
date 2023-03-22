<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessChild extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(UserMenuChild::class, 'user_menu_child_id', 'id');
    }
}
