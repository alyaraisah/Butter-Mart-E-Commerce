<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Category;

use App\Models\Product;

use App\Models\Order;

use App\Models\User; 

use App\Models\Cart;


use PDF;

class AdminController extends Controller
{
    public function view_category ()
    {
        if(Auth::id()){
            $data=category::all();
            return view('admin.category', compact('data'));
        }
        else{
            return redirect('login');
        }
    }

    public function add_category (Request $request)
    {
        $data=new category;
        $data->category_name=$request->category;
        $data->save();
        return redirect()->back()->with('message','Kategori Berhasil Ditambahkan!');
    }

    public function delete_category ($id) 
    {
        $data=category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Kategori Berhasil Dihapus!');
    }

    public function view_product() 
    {
        $category=category::all();
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request) 
    {
        $product=new product;

        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->dis_price;
        $product->category=$request->category;

        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);

        $product->image=$imagename;

        $product->save();

        return redirect()->back()->with('message', 'Produk Berhasil Ditambahkan!');
    }

    public function show_product() 
    {
        $product=product::all();
       return view('admin.show_product', compact('product'));
    }

    public function delete_product ($id) 
    {
        $product=product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Produk Berhasi Dihapus!');
    }

    public function update_product ($id) 
    {
        $product=product::find($id); 
        $category=category::all();
        return view('admin.update_product', compact('product', 'category'));
    }

    public function update_product_confirm (Request $request,$id) 
    {
        if(Auth::id()){
            $product=product::find($id); 
            $product->title=$request->title;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->discount_price=$request->dis_price;
            $product->category=$request->category;
            $product->quantity=$request->quantity;
            
            $image=$request->image;
            if($image)
            {
                $imagename=time().'.'.$image->getClientOriginalExtension();
                $request->image->move('product',$imagename);
                $product->image=$imagename;
            }
            
            $product->save();
            return redirect()->back()->with('message', 'Produk Berhasil Diubah!');
        } else{
            return redirect('login');
        }
        
    }
 
    public function order()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.order', compact('orders'));
    }

    public function cart()
    {
        $carts = Cart::all(); // Retrieve all cart items from the "carts" table
        return view('admin.cart', compact('carts'));
    }
    
    public function acceptOrder($orderId)
    {
        $cartItem = Cart::find($orderId);
        
        if (!$cartItem) {
            return redirect()->route('cart')->with('error', 'Item not found in the cart.');
        }
        
        // Find all cart items with the same user_id
        $cartItemsToMove = Cart::where('user_id', $cartItem->user_id)->get();
        
        foreach ($cartItemsToMove as $item) {
            // Create a new order record for each cart item
            $newOrder = new Order;
            $newOrder->user_id = $item->user_id;
            $newOrder->name = $item->name;
            $newOrder->email = $item->email;
            $newOrder->address = $item->address;
            $newOrder->phone = $item->phone;
            $newOrder->product_title = $item->product_title;
            $newOrder->quantity = $item->quantity;
            $newOrder->price = $item->price;
            $newOrder->payment_status = 'Paid on WA';
            $newOrder->delivery_status = 'processing';
            $newOrder->image = $item->image;
            $newOrder->product_id = $item->Product_id;
            // Add other columns as needed
            $newOrder->save();
        
            // Delete each item from the cart
            $item->delete();
        }
        
        return redirect()->route('cart')->with('message', 'Pesanan telah diterima dan dipindahkan ke daftar pesanan.');
    }   
    

    public function delivered1($created_at, $user_id)
    {
        // Ambil semua pesanan dengan created_at dan user_id yang sesuai
        $orders = Order::where('created_at', $created_at)
                    ->where('user_id', $user_id)
                    ->where('delivery_status', 'processing')
                    ->get();

        // Ubah status pengiriman dan status pembayaran untuk setiap pesanan
        foreach ($orders as $order) {
            $order->delivery_status = "Delivered";
            $order->payment_status = "Paid";
            $order->save();
        }

        return redirect()->back();
    }

    public function delivered($created_at, $user_id)
    {
        // Ambil semua pesanan dengan created_at dan user_id yang sesuai
        $orders = Order::where('created_at', $created_at)
                    ->where('user_id', $user_id)
                    ->where('delivery_status', 'processing')
                    ->get();

        // Ubah status pengiriman dan status pembayaran untuk setiap pesanan
        foreach ($orders as $order) {
            $order->delivery_status = "Delivered";
            $order->payment_status = "Paid";
            $order->save();

            // Decrease the product quantity in the database
            $product = Product::find($order->product_id);
            if ($product) {
                $product->update(['quantity' => $product->quantity - $order->quantity]);
            }
        }

        return redirect()->back();
    }


    
    public function print_pdf($id)
    {
        $order=order::find($id);
        $pdf=PDF::loadView('admin.pdf', compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function searchdata(Request $request)
    {
        $searchText = $request->search;
        $orders = Order::where('name', 'LIKE', '%' . $searchText . '%')->orwhere('phone', 'LIKE', '%' . $searchText . '%')->orwhere('product_title', 'LIKE', '%' . $searchText . '%')->get();
        return view('admin.order', compact('orders'));
    }

    public function searchdata2(Request $request)
    {
        $searchText = $request->search2;
        $carts = Cart::where('name', 'LIKE', '%' . $searchText . '%')->orwhere('product_title', 'LIKE', '%' . $searchText . '%')->get();
        return view('admin.cart', compact('carts'));
    }

    public function searchdata3(Request $request)
    {
        $product = Product::all(); // Fetch all products initially

        $searchText = $request->search3;

        // If there is a search text, filter the products
        if ($searchText) {
            $product = Product::where('title', 'LIKE', '%' . $searchText . '%')
                            ->orWhere('description', 'LIKE', '%' . $searchText . '%')
                            ->get();
        }

        return view('admin.show_product', compact('product'));
    }



}
