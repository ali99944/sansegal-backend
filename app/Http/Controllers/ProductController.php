<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('images', 'features')->get();
        return response()->json($products);
    }

    public function store(Request $request) {
        $validation = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'care_instructions' => 'required',
            'main_image' => 'required',
            'features' => 'required',
        ]);

        $decoded_features = json_decode($request->features);

        if($validation->fails()){
            return response()->json($validation->errors(), 400);
        }

        $image = $request->file('main_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $imageName);

        $product = Product::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'price' => $request->price,
            'discount' => $request->discount,
            'main_image' => $imageName,
            'care_instructions' => $request->care_instructions,
        ]);

        foreach ($decoded_features as $feature) {
            ProductFeature::create([
                'product_id' => $product->id,
                'name_ar' => $feature->name_ar,
                'name_en' => $feature->name_en,
            ]);
        }

        return response()->json($product);
    }

    public function update(Request $request, int $id) {
        $updated_product = Product::where('id', $id)->update($request->all());
        return response()->json($updated_product);
    }

    public function destroy(Request $request, int $id) {
        Product::where('id', $id)->delete();
    }
}
