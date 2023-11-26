<?php

namespace App\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(9);
        return view('home.userpage', compact('product'));
    }

    public function redirectgakjadi()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == "1") {
                $total_product = product::all()->count();
                $total_order = order::all()->count();
                $total_product = product::all()->count();
                $total_user = user::all()->count();
                $order = order::all();
                $total_revenue = 0;
                foreach ($order as $order) {
                    $total_revenue = $total_revenue + $order->price;
                }

                $total_delivered = order::where('delivery_status', '=', 'delivered')->get()->count();
                $total_processing = order::where('delivery_status', '=', 'processing')->get()->count();

                return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_delivered'));
            } else {
                $product = Product::paginate(9);
                return view('home.userpage', compact('product'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function redirect()
    {
        // You can remove the Auth::check() condition
        $usertype = Auth::check() ? Auth::user()->usertype : null;

        if ($usertype == "1") {
            if ($usertype == "1") {
                $total_product = product::all()->count();
                $total_order = order::all()->count();
                $total_product = product::all()->count();
                $total_user = user::all()->count();
                $order = order::all();
                $total_revenue = 0;
                foreach ($order as $order) {
                    $total_revenue = $total_revenue + $order->price;
                }

                $total_delivered = order::where('delivery_status', '=', 'delivered')->get()->count();
                $total_processing = order::where('delivery_status', '=', 'processing')->get()->count();

                return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_delivered'));
            }
        } else {
            $product = Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }


    public function product_details($id)
    {
        $product = product::find($id);
        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {
        $product = product::find($id);
        if ($product->quantity < $request->quantity) {
            $message = 'Produk ' . $product->title . ' sisa ' . $product->quantity;
            return redirect()->back()->with('message', $message);
        }
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $product = product::find($id);
            $product_exist_id = cart::where('Product_id', '=', $id)->where('user_id', '=', $userid)->get('id')->first();

            if ($product_exist_id) {
                $cart = cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $cart->quantity;
                } else {
                    $cart->price = $product->price * $cart->quantity;
                }
                $cart->save();
                return redirect()->back();
            } else {
                $cart = new cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->title;

                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $request->quantity;
                } else {
                    $cart->price = $product->price * $request->quantity;
                }
                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->quantity = $request->quantity;
                $cart->save();
                return redirect()->back();
            }
        } else {
            $product = Product::find($id);
            $cartItem = [
                'product_id' => $product->id,
                'product_title' => $product->title,
                'price' => $product->discount_price ? $product->discount_price * $request->quantity : $product->price * $request->quantity,
                'quantity' => $request->quantity,
                'image' => $product->image,
            ];
            if ($product->quantity < $request->quantity) {
                $message = 'Produk ' . $product->title . ' sisa ' . $product->quantity;
                return redirect()->back()->with('message', $message);
            }
            $existingCart = request()->cookie('cart_item');
            $cartArray = [];

            if ($existingCart) {
                $cartArray = json_decode($existingCart, true);
            }

            $itemIndex = -1;

            if (!empty($cartArray)) {
                for ($i = 0; $i < count($cartArray); $i++) {
                    // Verify if the key 'product_id' exists in the current array element
                    if (isset($cartArray[$i]['product_id']) && $cartArray[$i]['product_id'] == $cartItem['product_id']) {
                        $itemIndex = $i;
                        break;
                    }
                }
            }

            if ($itemIndex >= 0) {
                $cartArray[$itemIndex]['quantity'] += $cartItem['quantity'];
                // Recalculate the price based on the updated quantity
                $product = Product::find($id);
                $newPrice = $product->discount_price ? $product->discount_price * $cartArray[$itemIndex]['quantity'] : $product->price * $cartArray[$itemIndex]['quantity'];
                $cartArray[$itemIndex]['price'] = $newPrice;
            } else {
                $cartArray[] = $cartItem;
            }

            return redirect()->back()->withCookie(cookie()->forever('cart_item', json_encode($cartArray)));
        }
    }

    public function show_cart()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            return view('home.showcart', compact('cart'));
        } else {
            $cartFromCookies = request()->cookie('cart_item');
            $cart = [];

            if ($cartFromCookies) {
                $cart = json_decode($cartFromCookies, true);
            }

            return view('home.showcartguest', compact('cart'));
        }
    }

    public function remove_cart($id)
    {
        if(Auth::id()){
            $cart = Cart::find($id);
            $cart->delete();
            return redirect()->back();
        }else{
            $cartFromCookies = request()->cookie('cart_item');
            $cartArray = [];

            if ($cartFromCookies) {
                $cartArray = json_decode($cartFromCookies, true);

                foreach ($cartArray as $index => $cartItem) {
                    if ($cartItem['product_id'] == $id) {
                        unset($cartArray[$index]);

                        return redirect()->back()->withCookie(cookie()->forever('cart_item', json_encode($cartArray)));
                    }
                }
            }

            return redirect()->back();
        }
    }

    public function update_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $cart = Cart::find($id);

            if (!$cart) {
                return redirect()->back();
            }
            $product = Product::where('title', $request->title)->first();
            if ($product->quantity < $request->input('quantity')) {
                $message = 'Produk ' . $product->title . ' sisa ' . $product->quantity;
                return redirect()->back()->with('message', $message);
            } else {
                $cart->quantity = $request->input('quantity');
                $cart->save();

                $product = Product::where('title', $cart->product_title)->first();

                if (!$product) {
                    return redirect()->back();
                }

                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $cart->quantity;
                } else {
                    $cart->price = $product->price * $cart->quantity;
                }
                $cart->save();

                return redirect()->back();
            }
        } else {
            $cartFromCookies = request()->cookie('cart_item');
            $cartArray = [];

            if ($cartFromCookies) {
                $cartArray = json_decode($cartFromCookies, true);

                foreach ($cartArray as &$cartItem) {
                    if ($cartItem['product_id'] == $id) {
                        $product = Product::where('title', $cartItem['product_title'])->first();

                        if ($product && $product->quantity >= $request->input('quantity')) {
                            $cartItem['quantity'] = $request->input('quantity');
                            if ($product->discount_price != null) {
                                $cartItem['price'] = $product->discount_price * $request->input('quantity');
                            } else {
                                $cartItem['price'] = $product->price * $request->input('quantity');
                            }

                            return redirect()->back()->withCookie(cookie()->forever('cart_item', json_encode($cartArray)));
                        } else {
                            $message = 'Produk ' . $product->title . ' sisa ' . $product->quantity;
                            return redirect()->back()->with('message', $message);
                        }
                    }
                }
            }

            return redirect()->back();
        }
    }


    public function cash($totalproduct)
    {
        if ($totalproduct == 0) {
            return redirect()->back()->with('message', 'Please add some product');
        } else {
            $user = Auth::user();
            $userid = $user->id;
            $data = cart::where('user_id', '=', $userid)->get();

            foreach ($data as $data) {
                $order = new order;

                $order->name = $data->name;
                $order->email = $data->email;
                $order->phone = $data->phone;
                $order->address = $data->address;
                $order->user_id = $data->user_id;

                $order->product_title = $data->product_title;
                $order->price = $data->price;
                $order->quantity = $data->quantity;
                $order->image = $data->image;
                $order->product_id = $data->Product_id;

                $order->payment_status = 'cash on delivery';
                $order->delivery_status = 'processing';
                $order->save();

                $cart_id = $data->id;
                $cart = cart::find($cart_id);
                $cart->delete();
            }

            $this->pesan();

            return redirect()->back()->with('message', 'We have received your order. We will connect with you soon...');
        }
    }

    public function cash_order($totalproduct)
    {
        if ($totalproduct == 0) {
            return redirect()->back()->with('message', 'Please add some products');
        }

        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $carts = Cart::where('user_id', '=', $userid)->get();

            $message = '';
            $total = 0;
            $numbering = 1;

            $message .= 'Berikut ini produk yang kamu beli:';
            $message .= "\n";
            $product_nama = "";
            foreach ($carts as $cart) {
                $product_title = $cart->product_title;
                $quantity = $cart->quantity;
                // dd($cart);
                $product = Product::where('title', $product_title)->first();
                $price = $product->price;
                $user_pesan = User::where('id', $userid)->first();
                $user_name = $user_pesan->name;
                $user_email = $user_pesan->email;
                $user_phone = $user_pesan->phone;
                $user_address = $user_pesan->address;
                //$product->update(['quantity' => $product->quantity - $cart->quantity]);

                $subtotal = $price * $quantity;
                $total += $subtotal;

                $message .= $numbering . '. ' . $product_title . ', ' . $quantity . ' x ' . $price;
                $message .= "\n"; // This adds a newline character
                // dd($user_pesan);
                $numbering++;
                $product_nama .= $cart->product_title;
                $order = Order::create([
                    'user_id' => $userid,
                    'product_title' => $product_title,
                    'price' => $price,
                    'quantity' => $quantity,
                    'image' => $cart->image,
                    'product_id' => $cart->Product_id,
                    'payment_status' => 'Paid',
                    'delivery_status' => 'Delivered',
                    'name' => $user_name,
                    'email' => $user_email,
                    'phone' => $user_phone,
                    'address' => $user_address,
                ]);

            }

            $message .= "\n";
            $message .= 'Total Pembayaranmu: IDR ' . number_format($total, 0, ',', ',');
            $message .= "\n";
            $message .= 'Silahkan Kirim Pesan Ini!';
            //Cart::where('user_id', Auth::id())->delete();
            $adminNumber = env('WHATSAPP_ADMIN_NUMBER');
            return redirect('https://wa.me/6285888273995?text=' . urlencode($message));
        }else {
            // Pengguna tidak login, handle keranjang belanja dalam cookies
            $cartFromCookies = request()->cookie('cart_item');
            $cartArray = json_decode($cartFromCookies, true);
    
            if (!empty($cartArray)) {
                $message = 'Berikut ini produk yang kamu beli:';
                $message .= "\n";
                $total = 0;
                $numbering = 1;
    
                foreach ($cartArray as $cartItem) {
                    $product_title = $cartItem['product_title'];
                    $quantity = $cartItem['quantity'];
                    $product = Product::where('title', $product_title)->first();
                    $price = $product->price;
    
                    $subtotal = $price * $quantity;
                    $total += $subtotal;
    
                    $message .= $numbering . '. ' . $product_title . ', ' . $quantity . ' x ' . $price;
                    $message .= "\n";
                    $numbering++;
                }
    
                $message .= "\n";
                $message .= 'Total Pembayaranmu: IDR ' . number_format($total, 0, ',', ',');
                $message .= "\n";
                $message .= 'Silahkan Kirim Pesan Ini!';
                //Cookie::queue(Cookie::forget('cart_item'));
                // Hapus keranjang belanja dalam cookies
                return redirect('https://wa.me/6285888273995?text=' . urlencode($message));
            } else {
                return redirect()->back()->with('message', 'Keranjang Mu Kosong');
            }
        }
    }


    public function show_order()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;

            $order = order::where('user_id', $userid)->orderBy('created_at', 'desc')->get();
            return view('home.order', compact('order'));
        } else {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order = order::find($id);
        $order->delivery_status = 'Kamu membatalkan pesanan ini';

        $order->save();
        return redirect()->back();
    }

    public function product_search(Request $request)
    {
        $search_text = $request->search;
        $product = product::where('title', 'LIKE', '%' . $search_text . '%')->orwhere('category', 'LIKE', '%' . $search_text . '%')->paginate(9);
        return view('home.userpage', compact('product'));
    }

    public function product()
    {
        $product = Product::paginate(18);
        return view('home.all_product', compact('product'));
    }

    public function product1()
    {
        $product = Product::paginate(9);
        return view('home.userpage', compact('product'));
    }

    public function category_bahankue()
    {
        $category = 'bahan kue'; // Set the category you want to display
        $product = Product::where('category', $category)->paginate(12);
        return view('home.all_product', compact('product'));
    }

    public function category_bahankue1()
    {
        $category = 'bahan kue'; // Set the category you want to display
        $product = Product::where('category', $category)->paginate(9);
        return view('home.userpage', compact('product'));
    }

    public function category_bumbudapur()
    {
        $category = 'bumbu dapur'; // Set the category you want to display
        $product = Product::where('category', $category)->paginate(12);
        return view('home.all_product', compact('product'));
    }

    public function category_bumbudapur1()
    {
        $category = 'bumbu dapur'; // Set the category you want to display
        $product = Product::where('category', $category)->paginate(9);
        return view('home.userpage', compact('product'));
    }

    public function category_peralatandapur()
    {
        $category = 'peralatan dapur'; // Set the category you want to display
        $product = Product::where('category', $category)->paginate(12);
        return view('home.all_product', compact('product'));
    }

    public function category_peralatandapur1()
    {
        $category = 'peralatan dapur'; // Set the category you want to display
        $product = Product::where('category', $category)->paginate(9);
        return view('home.userpage', compact('product'));
    }

    public function category_plastik()
    {
        $category = 'plastik'; // Set the category you want to display
        $product = Product::where('category', $category)->paginate(12);
        return view('home.all_product', compact('product'));
    }

    public function category_plastik1()
    {
        $category = 'plastik'; // Set the category you want to display
        $product = Product::where('category', $category)->paginate(9);
        return view('home.userpage', compact('product'));
    }

    public function category_aksesoris()
    {
        $category = 'aksesoris'; // Set the category you want to display
        $product = Product::where('category', $category)->paginate(12);
        return view('home.all_product', compact('product'));
    }

    public function category_aksesoris1()
    {
        $category = 'aksesoris'; // Set the category you want to display
        $product = Product::where('category', $category)->paginate(9);
        return view('home.userpage', compact('product'));
    }

    public function category_search(Request $request)
    {
        $search_text = $request->search;
        $product = product::where('title', 'LIKE', '%' . $search_text . '%')->orwhere('category', 'LIKE', '%' . $search_text . '%')->paginate(12);
        return view('home.all_product', compact('product'));
    }


}


