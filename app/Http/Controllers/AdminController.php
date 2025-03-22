<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sale;
use App\Models\User;

class AdminController extends Controller
{
    public function Home()
    {
        $products = Product::all();
        return view('admin.admin_home', compact('products'));
    }

    public function admin_profile()
    {
        $user = Auth::user();
        return view('admin.admin_profile', compact('user'));
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

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.admin_home')->with('success', 'Product Deleted Successfully');
    }

    public function transaction()
    {
        $user = Auth::user();
        $sales = Sale::all();
        return view('admin.transaction', compact('user', 'sales'));
    }

    public function transactionDetail($order_id)
    {
        $sales = Sale::where('order_id', $order_id)->get();
        $data = Sale::where('id', $sales[0]->id)->first();
        $user = User::where('id', $sales[0]->user_id)->first();

        return view('admin.transaction_detail', compact('sales', 'data', 'user'));
    }

    public function transactionAccept(Request $request, $order_id)
    {
        // dd($request->all());

        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required|array',
            'quantity' => 'required|array',
        ]);
    
        if (count($request->product_id) !== count($request->quantity)) {
            return redirect()->back()->withErrors(['msg' => 'Jumlah produk dan kuantitas tidak sesuai']);
        }
    
        Sale::where('order_id', $request->order_id)->update(['status' => 3]);
    
        foreach ($request->product_id as $index => $product_id) {
            $quantity = $request->quantity[$index];
    
            Product::where('id', $product_id)->decrement('stock', $quantity);
        }
    
        return redirect()->route('admin.transaction');
    }

    public function transactionDecline($order_id)
    {
        Sale::where('order_id', $order_id)->update(['status' => 2]);
        return redirect()->route('admin.transaction');
    }

    public function transactionStatus(Request $request, $order_id)
    {
        dd($request->all());
    }
}
