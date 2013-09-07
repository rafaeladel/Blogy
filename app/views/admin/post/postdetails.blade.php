@extends('layout.layout')

@section('header')

@stop

@section('content')

@if(Auth::check())
    <h2>Main - Admin - Post Main menu</h2>
@else
    <h2>Main - {{ $post->title }} </h2>
@endif

@if(isset($message))
    <p>{{ $message }}</p>
@endif

@if(!empty($post))  
    <h4>{{ $post->title }}</h4>
    @if(Auth::check())
        {{ link_to_route('getEditPost', 'Edit', array('id' => $post->id)) }}
    @endif
    <h5>By : {{ $post->author }}</h5>
    <h5>Created at : {{ $post->created_at }} - {{ count($post->comments) }} Comment(s)</h5>
    <p>{{ $post->body }}</p>
    <hr>
    <ul>
    <h4>Comments:</h4>
    @foreach($post->comments as $comment)
    <li>
        <h5>{{ $comment->author}}</h5>
        <p>{{ $comment->body }}</p>
        @if(Auth::check())
            {{ link_to_route('getEditComment', 'Edit', array('comment_id' => $comment->id)) }}
            {{ Form::open(array('action' => array('CommentController@deleteComment', $comment->id))) }}
                 {{ Form::submit('delete') }}
            {{ Form::close() }}
        @endif
    </li>
    @endforeach
    </ul>
    <hr>
    {{ Form::open(array('action' => array ('CommentController@addComment', $post->id))) }}
        {{ Form::Label('author', 'Author: ') }}
        <br>
        {{ Form::text('author', '') }}
        {{ $errors->first('author') }}
        <br>
        {{ Form::Label('body', 'Body: ') }}
        <br>
        {{ Form::textarea('body', '', array('cols' => 40, 'rows'=> 5)) }}
        {{ $errors->first('body') }}
        <br>
        {{ Form::submit('Submit') }}
    {{ Form::close() }}
@endif

{{ link_to_route('listAllPosts', 'Back') }}
@stop