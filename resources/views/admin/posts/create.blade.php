@extends('layouts.admin')

{{-- @section('title')
    Posts
@endsection --}}


@section('content')
    <h1>Create Posts</h1>
    <div class="row">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true])!!}

            <div class="form-group">
                {!! Form::label('title', 'Title', ['class'=>'form-control-label'])!!}
                {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'PHP With Laravel'])!!}
            </div>

            <div class="form-group">
                {!! Form::label('body', 'Description', ['class'=>'form-control-label'])!!}
                {!! Form::textarea('body', null, ['class'=>'form-control', 'style'=>'resize: none;', 'placeholder'=>'Text Body...'])!!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id', 'Category', ['class'=>'form-control-label'])!!}
                {!! Form::select('category_id', [''=>'Select Category'] + $categories, 0, ['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Photo', ['class'=>'form-control-label'])!!}
                {!! Form::file('photo_id', ['class'=>'form-control'])!!}
            </div>      
            
            <div class="form-group">
                {!! Form::submit('Create Post', ['class'=>'btn btn-primary'])!!}
            </div>            

        {!! Form::close()!!}
    </div>

    <div class="row">
        @include('includes.form_error')
    </div>
@endsection

{{-- @section('footer')
    
@endsection --}}