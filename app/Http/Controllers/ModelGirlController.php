<?php

namespace App\Http\Controllers;

use App\Models\ModelGirl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModelGirlController extends Controller
{
    public function index() {
        $models = ModelGirl::all();
        return response()->json($models);
    }

    public function store(Request $request) {
        $validation = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id|integer'
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 400);
        }

        $image = $request->file('image');
        $name = $image->getClientOriginalName();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $name);

        $model = ModelGirl::create([
            'product_id' => $request->product_id,
            'image' => $name
        ]);

        return response()->json($model);
    }

    public function update(Request $request, int $id) {
        $updated_model = ModelGirl::where('id', $id)->update($request->all());
        return response()->json($updated_model);
    }

    public function destroy(Request $request, int $id) {
        ModelGirl::where('id', $id)->delete();
    }
}
