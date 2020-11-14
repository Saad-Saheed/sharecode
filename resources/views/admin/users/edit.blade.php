@extends('layouts.admin')

@section('content')

<h1>Edit User</h1>
<div class="col-sm-3 col-lg-3">
    <img style="width: 100%; height:auto;"  src="{{$user->path() . ($user->photo ? $user->photo->name : "default.png")}}" alt="No Photo" class="img-reponsive img-rounded">
</div>
<div class="col-sm-9 col-lg-9">
    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Full Name', ['class'=>'form-control-label'])!!}
            {!! Form::text('name', null, ['class'=>'form-control is-valid', 'placeholder'=>'saad saheed'])!!}
            
            @if ($errors->has('name'))
                <div class="invalid-feedback text-danger">Invalid Name Supplied!</div>
            @endif        
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email Address', ['class'=>'form-control-label'])!!}
            {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'example@gmail.com'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('role_id', 'Role', ['class'=>'form-control-label'])!!}
            {!! Form::select('role_id', $roles, null, ['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('is_active', 'Status', ['class'=>'form-control-label'])!!}
            {!! Form::select('is_active', array(1=>'Active', 0=>'Not Active'), null, ['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Passport', ['class'=>'form-control-label'])!!}
            {!! Form::file('photo_id', ['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password', ['class'=>'form-control-label'])!!}
            {!! Form::password('password', ['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update User', ['class'=>'btn btn-primary pull-left'])!!}
        </div>      
        

    {!! Form::close() !!}

    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id], 'class'=>'pull-right'])!!}
        <div class="form-group">
            {!! Form::submit('Delete User', ['class'=>'btn btn-danger'])!!}
        </div> 
    {!! Form::close() !!}

    @include('includes.form_error')
</div>

    
@endsection