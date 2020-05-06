<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Applications;

class ScheduleController extends Controller
{
    function get() {
        $data = Schedule::get();
        return response()->json($data);
    }
    function post(Request $request) {
        $model = new Schedule();
        $data = $request->all();
        $response = $model->create($data);
        if($request->id) {
            Applications::find($request->id)->delete();
        }
        return response()->json($response);
    }
    function edit(Request $request, $id) {
        $schedule = Schedule::find($id);
        $data = $request->all();
        $request = $schedule->update($data);
        return response('ok', 200);
    }
    function delete($id) {
        Schedule::find($id)->delete();
    }
}
