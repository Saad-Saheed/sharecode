<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PostsCreateRequest;
use Illuminate\Support\Facades\Auth;

use App\Post;
use App\Photo;
use App\Category;
use App\Http\Requests;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name', 'id')->all();
        return \view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $inputs = $request->all();
        // get this user id
        $user = Auth::user();
        // $inputs['user_id'] = $user_id;

        if($file = $request->file('photo_id')){
            // get file name
            $name = date('Y_m_d_his') . $file->getClientOriginalName();
            // remove the leading and unleading "/"
            $path = str_replace_first('/', '', Post::path());
            $path = str_replace_last('/', '', $path);
            //move photo to public/images/posts folder
            $file->move($path, $name);
            // insert photo name into db
            $photo = Photo::create(['name'=> $name]);
            // get photo id after we inserted it
            $inputs['photo_id'] = $photo->id;
        }

        $user->posts()->Create($inputs);

        return redirect('admin/posts');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
