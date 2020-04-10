<?php

namespace App\Http\Controllers\dashboard;

use App\Category;
use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::when($request->search ,function ($q) use ($request){

            return $q->whereTranslationLike('name','%'. $request->search .'%');

        })->latest()->paginate(5);;
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
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
            'ar.*'=>'required|unique:category_translations,name'
        ]);

        Category::create($request->all());

        if (app()->getLocale() == 'ar'){
            session()->flash('success','تم اضافة البيانات بنجاح');
        }else{
            session()->flash('success','category added successfully');
        }

        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
        $request->validate([
            'ar.*'=>'required|unique:category_translations,name'
        ]);

        $category->update($request->all());

        if (app()->getLocale() == 'ar'){
            session()->flash('success','تم تعديل البيانات بنجاح');
        }else{
            session()->flash('success','category updated successfully');
        }
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        if (app()->getLocale() == 'ar'){
            session()->flash('success','تم حذف البيانات بنجاح');
        }else{
            session()->flash('success','category deleted successfully');
        }
        return back();
    }
}
