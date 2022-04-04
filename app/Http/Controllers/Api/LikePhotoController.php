<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LikePhoto;
use App\Models\Photo;

class LikePhotoController extends Controller
{
    public function likePhoto($id)
    {
        $data = [
            'id_users' => auth()->user()->id,
            'id_photo' => $id,
        ];

        $photo = LikePhoto::select('id')->where($data)->first();


        if($photo){
            return $this->failure('Permintaan gagal diproses', []);
        }

        $result = LikePhoto::create($data);

        return $this->success_cud('Like Photo berhasil ditambah', []);
    }

    public function unlikePhoto($id)
    {
        $data = [
            'id_users' => auth()->user()->id,
            'id_photo' => $id,
        ];

        $photo = LikePhoto::select('id')->where($data)->first();


        if(!$photo){
            return $this->failure('Permintaan gagal diproses', []);
        }

        $result = LikePhoto::where($data)->delete();

        return $this->success_cud('Like Photo berhasil ditambah', []);
    }
}
