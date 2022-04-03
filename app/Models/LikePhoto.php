<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikePhoto extends Model
{
    use HasFactory;

    protected $table = 'like_photo';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
