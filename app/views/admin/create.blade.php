@extends('layout.layout')

@section('header')

@stop

@section('content')
<h2>Main - Admin - Create admin</h2>
    @if(isset($message))
        <p>{{ $message }}</p>
    @endif
    {{ Form::open(array('action' => 'UserController@postCreateAdmin')) }}
        {{ Form::Label('username', 'Username: ') }}
        <br>
        {{ Form::text('username', '') }}
        {{ $errors->first('username') }}
        <br>
        {{ Form::Label('password', 'Password: ') }}
        <br>
        {{ Form::text('password', '') }}
        {{ $errors->first('password') }}
        <br>
        {{ Form::submit('Submit') }}
    {{ Form::close() }}
@stop
