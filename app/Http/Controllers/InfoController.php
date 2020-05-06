<?php

namespace App\Http\Controllers;
use App\Models\Social;
use App\Models\Phone;
use App\Models\Info;
use App\Models\Slides;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    function getSocials() {
        $data = Social::get();
        return response()->json($data);
    }
    function postSocial(Request $request) {
        $model = new Social();
        $data = $request->all();
        if($request['logo']) {
            $name = "/img/socials/".uniqid().'.'.$request['logo']->getClientOriginalExtension();
            $request['logo']->move(public_path()."/img/socials/", $name);
            $data['logo'] = $name;
        }
        $response = $model->create($data);
        return response()->json($response);
    }
    function editSocial(Request $request, $id) {
        $model = Social::find($id);
        $data = $request->all();
        if(gettype($request['logo']) == "object") {
            $name = "/img/socials/".uniqid().'.'.$request['logo']->getClientOriginalExtension();
            $request['logo']->move(public_path()."/img/socials/", $name);
            $data['logo'] = $name;
        } else {
            $data['logo'] = $model->logo;
        }
        $model->update($data);
        return response('ok', 200);
    }
    function deleteSocial($id) {
        Social::find($id)->delete();
    }

    function getPhones() {
        $data = Phone::get();
        return response()->json($data);
    }
    function postPhone(Request $request) {
        $model = new Phone();
        $data = $request->all();
        $response = $model->create($data);
        return response()->json($response);
    }
    function editPhone(Request $request, $id) {
        $model = Phone::find($id);
        $data = $request->all();
        $model->update($data);
        return response('ok', 200);
    }

    function deletePhone($id) {
        Phone::find($id)->delete();
    }

    function getInfo() {
        $data = Info::get();
        return response()->json($data);
    }
    function editInfo(Request $request) {
        Info::where("key", $request->key)->update(['text' => $request->text]);
        return response('ok', 200);
    }
}
