@extends('layouts.admin')

@section('content')
{{-- FEEDBACK SECTION START --}}
    @if (session()->has('user_delete'))
    
        <div class="alert alert-danger alert-dismissible show" role="alert">
            <strong>{{session('user_delete')}}</strong>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    @elseif(session()->has('user_update'))

        <div class="alert alert-info alert-dismissible show" role="alert">
            <strong>{{session('user_update')}}</strong>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @elseif(session()->has('user_create'))

        <div class="alert alert-success alert-dismissible show" role="alert">
            <strong>{{session('user_create')}}</strong>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif

    {{-- FEEDBACK SECTION END --}}

    <h1>Users</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>

            @if ($users)
                @foreach ($users as $user)             
                <tr>
                    <td>{{$user->id}}</td>
                    <td><img height="50" src="{{$user->path() . ($user->photo ? $user->photo->name : "default.png")}}"></td>
                    <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->is_active ? "Active" : "None-Active"}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->subDays(0)->diffForHumans()}}</td>
                </tr>
                @endforeach
            @endif
        </tbody>

    </table>
@endsection