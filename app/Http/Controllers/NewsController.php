<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Comments;

class NewsController extends Controller
{
    function get() {
        $data = News::get();
        return response()->json($data);
    }
    function getId($id) {
        $data = news::with('comments')->find($id);
        return response()->json($data);
    }
    function post(Request $request) {
        $news = new News();
        $data = $request->all();
        if($request['photo']) {
            $name = "/img/news/".uniqid().'.'.$request['photo']->getClientOriginalExtension();
            $request['photo']->move(public_path()."/img/news/", $name);
            $data['photo'] = $name;
        }
        $news->create($data);
        return response('ok', 200);
    }
    function edit(Request $request, $id) {
        $news = News::find($id);
        $data = $request->all();
        if(gettype($request['photo']) == "object") {
            $name = "/img/news/".uniqid().'.'.$request['photo']->getClientOriginalExtension();
            $request['photo']->move(public_path()."/img/news/", $name);
            $data['photo'] = $name;
        } else {
            $data['photo'] = $news->photo;
        }
        $news->update($data);
        return response('ok', 200);
    }
    function delete($id) {
        News::find($id)->delete();
    }
    // comment
    function postComments(Request $request) {
        $model = new Comments();
        $data = $request->all();
        $request = $model->create($data);
        return response()->json($request);
    }
    function deleteComment($id) {
        Comments::find($id)->delete();
    }
}
