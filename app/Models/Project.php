<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'status',
        'visibility',
        'user_id'
    ];

    const STATUS_DRAFT = 0;
    const STATUS_OPEN = 1;
    const STATUS_CLOSE = 2;

    const VISIBILITY_PRIVATE = 1;
    const VISIBILITY_PUBLIC = 2;
}
