@extends('layout.layout')

@section('header')

@stop

@section('content')
<h2>Main - Admin - Add Post</h2>
<ul>
    @if(isset($message))
        <p>{{ $message }}</p>
    @endif
    {{ Form::open(array('action' => 'PostController@postAddPost')) }}
        {{ Form::Label('title', 'Title: ') }}
        <br>
        {{ Form::text('title', '') }}
        {{ $errors->first('title') }}
        <br>
        {{ Form::Label('body', 'Body: ') }}
        <br>
        {{ Form::textarea('body', '') }}
        {{ $errors->first('body') }}
        <br>
        {{ Form::submit('Submit') }}
    {{ Form::close() }}
    <li>{{ link_to_route('listAllPosts', 'Back') }}</li>
</ul>
@stop