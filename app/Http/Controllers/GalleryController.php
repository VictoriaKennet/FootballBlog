<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Video;

class GalleryController extends Controller
{
    function getPhotos() {
        $data = Photo::get();
        return response()->json($data);
    }
    function postPhotos(Request $request) {
        $uploadedFiles = $request->pics;
        foreach ($uploadedFiles as $file){
            $foto = new Photo;
            $name = "/img/photos/".uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path()."/img/photos/", $name);
            $foto->value = $name;
            $foto->save();
        }
    }
    function deletePhotos($id) {
        Photo::find($id)->delete();
    }

    function getVideos() {
        $data = Video::get();
        return response()->json($data);
    }
    function postVideos(Request $request) {
        $model = new Video();
        $data = $request->all();
        $model->create($data);
        return response('ok', 200);
    }
    function deleteVideos($id) {
        Video::find($id)->delete();
    }
}
