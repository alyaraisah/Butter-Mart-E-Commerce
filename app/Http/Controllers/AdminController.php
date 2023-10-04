<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Product;

use App\Models\Order;

use PDF;

class AdminController extends Controller
{
    public function view_category ()
    {
        $data=category::all();

        return view('admin.category', compact('data'));
    }

    public function add_category (Request $request)
    {
        $data=new category;
        $data->category_name=$request->category;
        $data->save();
        return redirect()->back()->with('message','Category Added Successfully!');
    }

    public function delete_category ($id) 
    {
        $data=category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully!');
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

        return redirect()->back()->with('message', 'Product dded Successfully');
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
        return redirect()->back()->with('message', 'Product Deleted Successfully!');
    }

    public function update_product ($id) 
    {
        $product=product::find($id); 
        $category=category::all();
        return view('admin.update_product', compact('product', 'category'));
    }

    public function update_product_confirm (Request $request,$id) 
    {
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
        return redirect()->back()->with('message', 'Product Updated Succesfully');
    }

 
    public function order()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.order', compact('orders'));
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



}
