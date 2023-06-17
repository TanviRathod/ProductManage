<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
       
        if(!empty($request->input('search')) || !empty($request->has('order'))){
            $query = Product::query();
           
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where('name', 'like', '%' . $searchTerm . '%');
            }
           
            if ($request->has('order')) {
                $orderOption = $request->input('order');
                if ($orderOption === 'high_to_low') {
                    $query->orderBy('price', 'desc');
                } elseif ($orderOption === 'low_to_high') {
                    $query->orderBy('price', 'asc');
                }
            }
            $products = $query->paginate(10);
            
    
        }
        else
        {
            $products = Product::paginate(10);
        }
        if ($request->ajax()) {
            $view = view('data', compact('products'))->render();
            return response()->json(['html' => $view]);
        }
        $total_prod = Product::count();
        return view('home',compact('products', 'total_prod'));
    }

    public function getProduct(){
        $products = Product::paginate(10);
        return response()->json(['html' => $products]);
    }

    public function adminHome(): View
    {
        return view('admin.index');
    }

}
