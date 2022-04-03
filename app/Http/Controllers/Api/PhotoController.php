<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use Validator;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function createPhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'caption' => 'nullable',
            'tags' => 'nullable',
            'add_foto' => 'required|image',
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors());
        }

        $nama_foto = $this->saveFile($request->file('add_foto'), DIR_UPLOAD);
        $data = [
            'id_users' => auth()->user()->id,
            'foto' => $nama_foto,
            'caption' => $request->caption,
            'tags' => $request->tags,
        ];

        $result = Photo::create($data);

        return $this->success_cud('Photo berhasil dibuat', $result);
    }

    public function updatePhoto(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'caption' => 'nullable',
            'tags' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors());
        }

        $data = [
            'caption' => $request->caption,
            'tags' => $request->tags,
        ];

        $id = Photo::findOrFail($id)->update($data);
        $result = Photo::find($id);

        return $this->success_cud('Photo berhasil diupdate', $result);
    }

    public function deletePhoto($id)
    {
        $photo = Photo::findOrFail($id);
        $this->deleteFile($photo->foto, DIR_UPLOAD);
        $photo->delete();

        return $this->success_cud('Photo berhasil didelete', []);
    }

    public function getPhoto(Request $request)
    {
        $result = Photo::get();
        return $this->success_list('Pengambilan data list photo berhasil', $result);
    }

    public function getPhotoDetail($id)
    {
        $result = Photo::select('photo.*', 'photo.id_users')
            ->selectRaw('count(like_photo.id) as like')
            ->leftJoin('like_photo', 'photo.id', 'like_photo.id_photo')
            ->where('photo.id', $id)
            ->groupBy('photo.id')
            ->get();
        return $this->success_list('Pengambilan data detail photo berhasil', $result);
    }
}
