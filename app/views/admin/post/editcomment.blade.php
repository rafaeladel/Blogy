@extends('layout.layout')

@section('header')

@stop

@section('content')
<h2>Main - Admin - Edit Comment</h2>
<ul>
    @if(isset($message))
        <p>{{ $message }}</p>
    @endif
    {{ Form::model($comment, array('action' => array('CommentController@postEditComment', $comment->id))) }}
        {{ Form::Label('body', 'Body: ') }}
        <br>
        {{ Form::textarea('body') }}
        {{ $errors->first('body') }}
        <br>
        {{ Form::submit('Submit') }}
    {{ Form::close() }}
    <li>{{ link_to_route('listSinglePost', 'Back', array("id" => $comment->post_id)) }}</li>
</ul>
@stop