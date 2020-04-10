<?php

namespace App\Http\Controllers\dashboard;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::when($request->search , function ($q) use ($request) {
            return $q->whereTranslationLike('name','%'. $request->search .'%');
        })->when($request->category_id, function ($q) use ($request){
            return $q->where('category_id',$request->category_id);
        })->latest()->paginate(5);
        return view('dashboard.products.index',compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'purchase_price' =>'required',
            'sale_price' =>'required',
            'stock' =>'required',
            'category_id' => 'required'
        ]);
        $request_data = $request->all();

        if ($request->image){
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/products_img/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

         Product::create($request_data);
        if (app()->getLocale() == 'ar'){
            session()->flash('success','تم اضافة البيانات بنجاح');
        }else{
            session()->flash('success','Product added successfully');
        }
        return redirect()->route('dashboard.products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'purchase_price' =>'required',
            'sale_price' =>'required',
            'stock' =>'required',
            'category_id' => 'required'
        ]);
        $request_data = $request->all();

        if ($request->image){

            if ($product->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/products_img/'.$product->image);
            }

            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/products_img/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        $product->update($request_data);

        if (app()->getLocale() == 'ar'){
            session()->flash('success','تم تعديل البيانات بنجاح');
        }else{
            session()->flash('success','Product updated successfully');
        }
        return redirect()->route('dashboard.products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image != 'default.png'){
            Storage::disk('public_uploads')->delete('/products_img/'.$product->image);
        }
        $product->delete();

        if (app()->getLocale() == 'ar'){
            session()->flash('success','تم مسح البيانات بنجاح');
        }else{
            session()->flash('success','Product deleted successfully');
        }
        return redirect()->route('dashboard.products.index');

    }
}
