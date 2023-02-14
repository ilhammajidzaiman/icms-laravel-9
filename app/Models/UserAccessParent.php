<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessParent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(UserMenu::class, 'parent_id', 'id');
    }
}
