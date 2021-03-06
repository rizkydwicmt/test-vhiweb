<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photo';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function likePhotos()
    {
        return $this->hasMany('App\Models\LikePhoto', 'id_photo');
    }
}
