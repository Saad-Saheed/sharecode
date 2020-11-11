@extends('layouts.admin')

@section('content')

<h1>Create User</h1>

{!! Form::open(['method'=>'post', 'action'=>'AdminUsersController@store', 'files'=>true]) !!}
     <div class="form-group">
        {!! Form::label('name', 'Full Name', ['class'=>'form-control-label'])!!}
        {!! Form::text('name', '', ['class'=>'form-control is-valid', 'placeholder'=>'saad saheed'])!!}
        
        @if ($errors->has('name'))
            <div class="invalid-feedback text-danger">Invalid Name Supplied!</div>
        @endif        
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email Address', ['class'=>'form-control-label'])!!}
        {!! Form::email('email', '', ['class'=>'form-control', 'placeholder'=>'example@gmail.com'])!!}
    </div>

    <div class="form-group">
        {!! Form::label('role_id', 'Role', ['class'=>'form-control-label'])!!}
        {!! Form::select('role_id', [''=>'Choose Option'] + $roles, null, ['class'=>'form-control'])!!}
    </div>

    <div class="form-group">
        {!! Form::label('is_active', 'Status', ['class'=>'form-control-label'])!!}
        {!! Form::select('is_active', array(1=>'Active', 0=>'Not Active'), 0, ['class'=>'form-control'])!!}
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
        {!! Form::submit('Create User', ['class'=>'btn btn-primary'])!!}
    </div>
    

{!! Form::close() !!}

@include('includes.form_error')
    
@endsection