<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Model;
use App\Models\Management\UserMenuChild;
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
