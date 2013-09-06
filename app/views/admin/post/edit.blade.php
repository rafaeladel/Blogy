@extends('layout.layout')

@section('header')

@stop

@section('content')
<h2>Main - Admin - Edit Post</h2>
<ul>
    @if(isset($message))
        <p>{{ $message }}</p>
    @endif
    {{ Form::model($post, array('action' => array('PostController@postEditPost', $post->id))) }}
        {{ Form::Label('title', 'Title: ') }}
        <br>
        {{ Form::text('title') }}
        {{ $errors->first('title') }}
        <br>
        {{ Form::Label('body', 'Body: ') }}
        <br>
        {{ Form::textarea('body') }}
        {{ $errors->first('body') }}
        <br>
        {{ Form::submit('Submit') }}
    {{ Form::close() }}
    <li>{{ link_to_route('listSinglePost', 'Back', array("id" => $post->id)) }}</li>
</ul>
@stop