<?php

namespace App\Http\Controllers\dashboard;

use App\Category;
use App\Client;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        $clients = Client::all();
        $orders = Order::all();
        return view('dashboard.index',compact('products','categories','clients','orders'));
    }
}
