<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Application;

class AppointmentController extends Controller
{
    public function index() {
        return view('appoint');
    }

    public function saveAppointment(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'application' => 'required',
                'last_name' => 'required',
                'given_name' => 'required',
                'sex' => 'required',
            ]
        );
        $response = array(
            'status' => 0,
            'error' => array(),
        );
        if ($validator->fails()) {
            $response['status'] = 1;
            $response['errors'] = $validator->errors();
        } else {
            // logic for saving
        }
    }

    public function dropDownApplication() {
        $applications = Application::all();
        return response()->json($applications);
    }
}