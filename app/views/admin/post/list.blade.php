@extends('layout.layout')

@section('header')

@stop

@section('content')

@if(Auth::check())
    <h2>Main - Admin - Post Main menu</h2>
@else 
    <h2>Main - Posts</h2>
@endif

@if(Auth::check())
    <ul>
        <li>{{ link_to_route('getAddPost', 'Add') }}</li>
    </ul>
@endif

@if(isset($message))
    <p>{{ $message }}</p>
@endif

@if(isset($posts))  
    <ul>
    @foreach($posts as $post)
    <li>
        <span>{{ $post->body }} - {{ count($post->comments) }} Comment(s)</span>
        @if(Auth::check())
            {{ Form::open(array('action' => array('PostController@deletePost', $post->id))) }}
                 {{ Form::submit('delete') }}
            {{ Form::close() }}
        @endif
        {{ link_to_action('PostController@showPost', 'Details', array("id" => $post->id)) }} 
    </li>
    @endforeach
    </ul>
@endif

@if(Auth::check())
    {{ link_to('admin/', 'Back') }}
@else 
    {{ link_to('/', 'Back') }}
@endif

@stop