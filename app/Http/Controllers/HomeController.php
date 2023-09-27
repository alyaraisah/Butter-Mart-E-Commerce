<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $product=Product::paginate(9);
        return view('home.userpage', compact('product'));
    }

    public function redirect()
    {
    // Check if a user is authenticated
    if (Auth::check()) {
        $usertype = Auth::user()->usertype;

        if ($usertype == "1") {
            return view('admin.home');
        } 
        else {
            $product=Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    } else {
        return redirect()->route('login'); 
    }
}

}
