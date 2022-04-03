<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function createPhoto(Request $request)
    {
        $nama_foto = $this->saveFile($request->file('add_foto'), DIR_UPLOAD);
        $data = [
            'id_users' => auth()->user()->id,
            'foto' => $nama_foto,
        ];

        return Photo::create($data);
    }

    public function getPhoto(Request $request)
    {
        return Photo::get();
    }
}
