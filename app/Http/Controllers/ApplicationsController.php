<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applications;

class ApplicationsController extends Controller
{
    function get() {
        $data = Applications::get();
        return response()->json($data);
    }
    function post(Request $request) {
        $model = new Applications();
        $data = $request->all();
        $model->create($data);
        return response('ok', 200);
    }
    function delete($id) {
        Applications::find($id)->delete();
    }
}
