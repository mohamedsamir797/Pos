<?php

namespace App\Http\Controllers\dashboard;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $clients = Client::when($request->search , function ($q) use ($request){
           return $q->where('name','like','%'. $request->search .'%')
               ->orwhere('phone','like','%'. $request->search .'%')
               ->orwhere('address','like','%'. $request->search .'%');
       })->latest()->paginate(5);
       return view('dashboard.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.create');
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
            'name' => 'required',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        Client::create($request->all());

        if (app()->getLocale() == 'ar'){
            session()->flash('success','تم اضافة البيانات بنجاح');
        }else{
            session()->flash('success','category added successfully');
        }

        return redirect()->route('dashboard.clients.index');
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
    public function edit(Client $client)
    {
        return view('dashboard.clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Client $client)
    {
        $request->validate([
            'name' => 'required',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        $client->update($request->all());

        if (app()->getLocale() == 'ar'){
            session()->flash('success','تم تعديل البيانات بنجاح');
        }else{
            session()->flash('success','category updated successfully');
        }

        return redirect()->route('dashboard.clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('dashboard.clients.index');
    }
}
