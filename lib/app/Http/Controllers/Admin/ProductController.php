<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Models\VpCategory;
use App\Models\VpProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function getProduct()
    {
        $product_list = DB::table('vp_products')->join('vp_categories','vp_products.prod_cate', '=', 'vp_categories.cate_id')->orderBy('prod_id','desc')->paginate(3);
        return view('backend.product', compact('product_list'));
    }

    public function getCreateProduct()
    {
        $categories = VpCategory::all();
        return view('backend.addproduct', compact('categories'));
    }

    public function postCreateProduct(AddProductRequest $request)
    {
        $filename = $request->img->getClientOriginalName(); // lay file anh

        $product = new VpProduct;

        $product->prod_name = $request->product_name;
        $product->prod_slug = Str::slug( $request->product_name);
        $product->prod_img = $filename;
        $product->prod_trademark = $request->trademark;
        $product->prod_price = $request->price;
        $product->prod_size = $request->size;
        $product->prod_status = $request->status;
        $product->prod_description = $request->description;
        $product->prod_cate = $request->cate;
        $product->prod_featured = $request->featured;
        $request->img->storeAs('avatar',$filename);
        $product->save();

        return redirect()->intended('admin/product');
    }

    public function getEditProduct($id)
    {
        $product = VpProduct::find($id);
        $categories = VpCategory::all();
        return view('backend.editproduct', compact('product', 'categories'));
    }

    public function putUpdateProduct(AddProductRequest $request, $id)
    {
        $product = VpProduct::find($id);

        $product->prod_name = $request->product_name;
        $product->prod_slug = Str::slug($request->product_name);
        $product->prod_trademark = $request->trademark;
        $product->prod_price = $request->price;
        $product->prod_size = $request->size;
        $product->prod_status = $request->status;
        $product->prod_description = $request->description;
        $product->prod_cate = $request->cate;
        $product->prod_featured = $request->featured;
        if($request->hasFile('img')) {
            $img = $request->img->getClientOriginalName();
            $product->prod_img = $img;
        $request->img->storeAs('avatar',$img);
        }
        $product->save();
        return redirect()->intended('admin/product');
    }

    public function getDeleteProduct($id)
    {
        $product = VpProduct::find($id);

        $product->delete();

        return redirect()->intended('admin/product');
    }
}
