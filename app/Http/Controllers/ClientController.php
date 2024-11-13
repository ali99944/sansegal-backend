<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function store(Request $request) {
        $validation = Validator::make($request->all(),[
            'name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required',
            'other_phone_number' => 'required',
            'country' => 'required',
            'city' => 'required'
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 400);
        }

        $client = Client::create(
            $request->all()
        );

        return $client;
    }
}
