<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Home()
    {
        $products = Product::all();
        return view('admin.admin_home', compact('products'));
    }

    public function addProduct()
    {
        return view('admin.add_product');
    }

    public function addProductProcess(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'product_name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'stock' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data_produk['product_name'] = $request->product_name;
        $data_produk['description'] = $request->description;
        $data_produk['category'] = $request->category;
        
        if($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $name = date('Y-m-d_H-i-s') . '.' . $image->getClientOriginalName();
            $destinationPath = public_path('/assets/product');
            $image->move($destinationPath, $name);
            $data_produk['product_image'] = $name;
        }
        
        $data_produk['stock'] = $request->stock;
        $data_produk['price'] = $request->price;

        Product::create($data_produk);

        return redirect()->route('admin.admin_home')->with('success', 'Produk berhasil ditambahkan');
    }
    public function editProduct($id)
    {
        $product = Product::find($id);
        return view('admin.edit_product', compact('product'));
    }
    public function editProductProcess(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'product_name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'stock' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data_produk['product_name'] = $request->product_name;
        $data_produk['description'] = $request->description;
        $data_produk['category'] = $request->category;
        
        if($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $name = date('Y-m-d_H-i-s') . '.' . $image->getClientOriginalName();
            $destinationPath = public_path('/assets/product');
            $image->move($destinationPath, $name);
            $data_produk['product_image'] = $name;
        }
        
        $data_produk['stock'] = $request->stock;
        $data_produk['price'] = $request->price;

        $product = Product::find($id);
        $product->update($data_produk);

        return redirect()->route('admin.admin_home')->with('success', 'Product Edited Successfully');
    }
}
