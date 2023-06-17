<?php

namespace App\Models\NavMenu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NavMenuParent extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
}
