@extends('layouts.admin')

{{-- @section('title')
    Posts
@endsection --}}


@section('content')
    <h1>Posts</h1>

    <table class="table">
        <thead>
            <th>Id</th>
            <th>Photo</th>
            <th>Postal Name</th>
            <th>Post Category</th>            
            <th>Title</th>
            <th>Body</th>            
            <th>Created</th>
            <th>Updated</th>
        </thead>

        <tbody>
            @if ($posts)
                
                @foreach ($posts as $post)                        
                    <tr>
                        <td>{{$post->id}}</td>
                        <td><img height="50" src="{{$post::path() . ($post->photo ? $post->photo->name : 'default.png')}}" alt="No Photo"></td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->category ? $post->category->name : "UnCategorized"}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->body}}</td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach

            @endif
        </tbody>
    </table>
@endsection

{{-- @section('footer')
    
@endsection --}}