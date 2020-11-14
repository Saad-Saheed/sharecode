<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Session;

use App\Role;

use App\User;

use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        // return  $request->all();

        if(trim($request->password) == ''){
            $inputs = $request->except('password');
        }
        else{
            $inputs = $request->all();
            $inputs['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photo_id')){

            $name = date('Y_m_d_his') . $file->getClientOriginalName();
            $file->move('images/users', $name);
            $photo = Photo::create(['name' => $name]);
            $inputs['photo_id'] = $photo->id;

        }

        User::create($inputs);

         // using session class
         Session::flash('user_create', 'user has created Successfully');

         // using global session
         // session(['user_delete'=>'user has been deleted Successfully']);
 
         // using request or local session
         // $request->session()->flash(['user_delete'=>'user has been deleted Successfully']);

        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.user.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::lists('name', 'id')->all();

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if(trim($request->password) == ''){

            $inputs = $request->except('password');
        }
        else{
            $inputs = $request->all();
            $inputs['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photo_id')){

            $name = date('Y_m_d_his') . $file->getClientOriginalName();
            // remove the leading and unleading "/" from path method
            $path = str_replace_first('/', '', $user->path());
            $path = str_replace_last('/', '', $path);

            $file->move($path, $name);
            $photo = Photo::create(['name'=>$name]);
            $inputs['photo_id'] = $photo->id;
        }

        $user->update($inputs);

         // using session class
        //  Session::flash('user_delete', 'user has been deleted Successfully');

         // using global session
         // session(['user_delete'=>'user has been deleted Successfully']);
 
        //  using request or local session
         $request->session()->flash('user_update', 'user has been updated Successfully');

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $photo_name = $user->photo->name;
        // remove the leading "/" from path method
        $path = str_replace_first('/', '', $user->path());
        // remove this user picture
        unlink($path . $photo_name);
        
        $user->delete();
        
        // using session class
        Session::flash('user_delete', 'user has been deleted Successfully');

        // using global session
        // session(['user_delete'=>'user has been deleted Successfully']);

        // using request or local session
        // $request->session()->flash(['user_delete'=>'user has been deleted Successfully']);

        return redirect('/admin/users');
    }
}
