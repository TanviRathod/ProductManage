<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.create',compact('categories')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = implode(',',$request->category_id);
        if($request->file('image'))
        {
            $file=$request->file('image');
            $file_name = $file->getClientOriginalName();
            $file->move('images',$file_name);
        }
        $product->image= $file_name;
        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product_edit = Product::find($id);
        $categories = Category::all();
       return view('admin.edit',compact('product_edit','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = implode(',',$request->category_id);
        if($request->file('image'))
        {
            $file=$request->file('image');
            $file_name = $file->getClientOriginalName();
            $file->move('images',$file_name);
            $product->image= $file_name; 
        }
        
        $product->update();

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getdata(Request $request)
    {
       
        if ($request->ajax()) {
           $data = Product::get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('category_id',function($row){
                        $arr = explode(",",$row->category_id);
                    $data = Category::whereIn('id',$arr)->get();
                    
                    foreach($data as $row)
                    {
                        $tdata[] = $row->name;
                    } 
                     return $tdata;  
                    })
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="'.route('product.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                            $btn .= '<a href="'.route('product.delete',$row->id).'" class="edit btn btn-danger btn-sm ml-2">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
          
        return view('admin.index');
    }

    public function delete($id)
    {
       Product::find($id)->delete();
       return redirect()->route('product.index');
    }
}
