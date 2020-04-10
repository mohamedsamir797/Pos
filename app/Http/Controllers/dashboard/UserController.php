<?php

namespace App\Http\Controllers\dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:read_users')->only('index');
        $this->middleware('permission:create_users')->only('create');
        $this->middleware('permission:update_users')->only('update');
        $this->middleware('permission:delete_users')->only('destroy');

    }

    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function ($q) use ($request){

            return $q->when($request->search,function ($query) use ($request){
                return $query->where('first_name','like','%'.$request->search .'%')->orWhere('last_name','like','%'.$request->search.'%');
            });
        })->latest()->paginate(5);;

        return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
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
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',
            'permissions' => 'required'
        ]);
        $request_data = $request->except(['password','password_confirmation','permissions','image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image){
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users_img/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        $user = User::create($request_data);

        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        if (app()->getLocale() == 'ar'){
            session()->flash('success','تم اضافة البيانات بنجاح');
        }else{
            session()->flash('success','User added successfully');
        }
        return redirect()->route('dashboard.users.index');
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
    public function edit($id)
    {
        $user = User::find($id);
        return view('dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $request->validate([
            'first_name' =>'required',
            'last_name' =>'required',
            'email' =>'required',
            'image'=> 'required|image',
            'permissions' => 'required'
        ]);
        $request_data = $request->except(['permissions','image']);

        if ($request->image){

            if ($user->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/users_img/'.$user->image);
            }

            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users_img/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

       $user->update($request_data);
       $user->syncPermissions($request->permissions);

        if (app()->getLocale() == 'ar'){
            session()->flash('success','تم تعديل البيانات بنجاح');
        }else{
            session()->flash('success','User updated successfully');
        }
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->image != 'default.png'){
            Storage::disk('public_uploads')->delete('/users_img/'.$user->image);
        }
        $user->delete();
        if (app()->getLocale() == 'ar'){
            session()->flash('success','تم مسح البيانات بنجاح');
        }else{
            session()->flash('success','User deleted successfully');
        }
        return back();
    }
}
