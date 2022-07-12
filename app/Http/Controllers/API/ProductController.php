<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'business_detail_id' => 'required|exists:business_details,id',
                'productcategory_field' => 'required|exists:product_categories,id',
                'productname_field' => 'required',
                'price_field' => 'required',
                'stock_field' => 'required',
                'description_field' => 'required',
                'productiondate_field' => 'required',
                'discount_field' => 'nullable',
                'weight_field' => 'nullable',
            ]);

            if ($request->hasFile('thumbnail_field')) {

                $request->validate([
                    'thumbnail_field' => 'required|mimes:jpeg,png,jpg',
                ]);

                // delete old image
                $product = Product::find($id);
                if ($product->thumbnail) {
                    $old_image = public_path($product->thumbnail);
                    if (file_exists($old_image)) {
                        unlink($old_image);
                    }
                }

                $file = $request->file('thumbnail_field');
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('products'), $fileName);

                $product = Product::find($id);
                $product->business_detail_id = $request->business_detail_id;
                $product->name = $request->productname_field;
                $product->product_category_id = $request->productcategory_field;
                $product->price = $request->price_field;
                $product->stock = $request->stock_field;
                $product->description = $request->description_field;
                $product->production_date = $request->productiondate_field;
                $product->discount = $request->discount_field;
                $product->weight = $request->weight_field;
                $product->thumbnail = 'products/' . $fileName;
                $product->save();
            } else {
                $product = Product::find($id);
                $product->business_detail_id = $request->business_detail_id;
                $product->name = $request->productname_field;
                $product->product_category_id = $request->productcategory_field;
                $product->price = $request->price_field;
                $product->stock = $request->stock_field;
                $product->description = $request->description_field;
                $product->production_date = $request->productiondate_field;
                $product->discount = $request->discount_field;
                $product->weight = $request->weight_field;
                $product->save();
            }

            return back()->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            // return back()->with('error', 'Something went wrong');
        }
    }


    function fetch($id)
    {
        return response()->json(Product::find($id));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'business_detail_id' => 'required|exists:business_details,id',
                'productcategory_field' => 'required|exists:product_categories,id',
                'productname_field' => 'required',
                'price_field' => 'required',
                'stock_field' => 'required',
                'description_field' => 'required',
                'thumbnail_field' => 'required|mimes:jpeg,png,jpg',
                'productiondate_field' => 'required',
                'discount_field' => 'nullable',
                'weight_field' => 'nullable',
            ]);

            if ($request->hasFile('thumbnail_field')) {
                $file = $request->file('thumbnail_field');
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('products'), $fileName);
            }

            $product = Product::create([
                'business_detail_id' => $request->business_detail_id,
                'product_category_id' => $request->productcategory_field,
                'name' => $request->productname_field,
                'price' => $request->price_field,
                'stock' => $request->stock_field,
                'description' => $request->description_field,
                'thumbnail' => 'products/' . $fileName,
                'production_date' => $request->productiondate_field,
                'discount' => $request->discount_field,
                'weight' => $request->weight_field,
            ]);

            return back()->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);
            // delete old image
            if ($product->thumbnail) {
                $old_image = public_path($product->thumbnail);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $product->delete();
            return back()->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }
}
