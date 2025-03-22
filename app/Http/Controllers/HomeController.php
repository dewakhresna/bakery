<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Sale;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $cupcakes = Product::where('category', 'CupCakes')->get();
        $cookies = Product::where('category', 'Cookies')->get();
        $cheesecakes = Product::where('category', 'CheeseCakes')->get();
        return view('user.home', compact('products', 'cupcakes', 'cookies', 'cheesecakes'));
    }

    public function home()
    {
        $user = Auth::user();
        $cupcakes = Product::where('category', 'CupCakes')->get();
        $cookies = Product::where('category', 'Cookies')->get();
        $cheesecakes = Product::where('category', 'CheeseCakes')->get();
        $products = Product::all();
        return view('user.home', compact('user', 'products', 'cupcakes', 'cookies', 'cheesecakes'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function edit_profile()
    {
        $user = Auth::user();
        return view('user.edit_profile', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'detailed_address' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $data_user['username'] = $request->username;
        $data_user['email'] = $request->email;
        $data_user['phone'] = $request->phone;
    
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = date('Y-m-d_H-i-s') . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('/assets/profile_picture');
            $image->move($destinationPath, $name);
            $data_user['photo'] = $name; // Set nama file baru
        } 
    
        $data_user['address'] = $request->address;
        $data_user['detailed_address'] = $request->detailed_address;
    
        $user = User::find($id);
        $user->update($data_user);
    
        return redirect()->route('user.user_home');
    }

    public function addCart($id)
    {
        $product = Product::find($id);
        $user = Auth::user();
        return view('user.add_cart', compact('product', 'user'));
    }

    public function addCartProcess(Request $request, $id)
    {
        // dd($request->all());
        $product = Product::find($id);
        $user = Auth::user();
        request()->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'product_name' => 'required',
            'product_image' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $data_cart['user_id'] = $user->id;
        $data_cart['product_id'] = $product->id;
        $data_cart['product_name'] = $product->product_name;
        $data_cart['product_image'] = $product->product_image;
        $data_cart['price'] = $product->price;
        $data_cart['quantity'] = $request->quantity;
        $data_cart['sub_total'] = $product->price * $request->quantity;

        Cart::create($data_cart);
        return redirect()->route('user.user_home');
    }
    public function cart()
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();
        return view('user.cart', compact('user', 'carts'));
    }

    public function deleteCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->route('user.cart');
    }

    public function checkout(Request $request)
    {
        // dd($request->all());

        foreach ($request->product_name as $key => $product_name) {
            Sale::create([
                'order_id' => date('Y-m-d_H-i-s') . '-' . $request->user_id[$key],
                'user_id' => $request->user_id[$key],
                'product_id' => $request->product_id[$key],
                'product_name' => $product_name,
                'product_image' => $request->product_image[$key],
                'price' => $request->price[$key],
                'quantity' => $request->quantity[$key],
                'sub_total_product' => $request->sub_total_product[$key],
                'total_quantity' => $request->total_quantity,
                'sub_total' => $request->sub_total,
            ]);

            $order_id = date('Y-m-d_H-i-s') . '-' . $request->user_id[$key];

            Cart::where('product_id', $request->product_id[$key])->delete();
        }

        return redirect()->route('user.payment', $order_id)->with('success', 'Checkout Berhasil');
    }

    public function payment($order_id)
    {
        $sales = Sale::where('order_id', $order_id)->get();
        $data = Sale::where('id', $sales[0]->id)->first();
        $user = User::where('id', $sales[0]->user_id)->first();
        
        return view('user.payment', compact('sales', 'data', 'user'));
    }

    public function payment_process(Request $request, $order_id)
    {
        // Validasi input dari pengguna
        $request->validate([
            'payment_method' => 'required',
            'payment_confirmation' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'total_amount' => 'required',
        ]);

        // Data yang akan disimpan
        
        if ($request->hasFile('payment_confirmation')) {
            $image = $request->file('payment_confirmation');
            $name = date('Y-m-d_H-i-s') . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('/assets/payment');
            $image->move($destinationPath, $name);
            $data_sales['payment_confirmation'] = $name;
        }
        
        $data_sales['payment_method'] = $request->payment_method;
        $data_sales['total_amount'] = $request->total_amount;
        $data_sales['status'] = 1;

        // Cari data penjualan berdasarkan ID
        $sales = Sale::where('order_id', $order_id);

        if ($sales) {
            // Update data dan simpan ke database
            $sales->update($data_sales);

            // Redirect ke halaman user dengan pesan sukses
            return redirect()->route('user.user_home')->with('success', 'Pembayaran berhasil diproses.');
        } else {
            // Jika data tidak ditemukan, tampilkan error
            return redirect()->back()->withErrors(['error' => 'Pesanan tidak ditemukan.']);
        }
    }

    public function delete_payment($order_id)
    {
        Sale::where('order_id', $order_id)->delete();
        return redirect()->route('user.user_home');
    }

    public function order_status()
    {
        $user = Auth::user();
        $sales = Sale::where('user_id', $user->id)->get();
        $orders = Sale::where('id', $sales[0]->id)->first();
        return view('user.order_status', compact('user', 'sales', 'orders'));
    }
}
