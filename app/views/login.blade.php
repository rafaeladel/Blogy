@extends('layout.layout')

@section('header')

@stop

@section('content')
<h2>Main - Admin - Login</h2>
    @if(isset($message))
        <p>{{ $message }}</p>
    @endif
    {{ Form::open(array('action' => 'UserController@postLogin')) }}
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
        {{ Form::Label('rememberme', 'Remember Me') }}
        {{ Form::checkbox('rememberme', 1, false) }}
        {{ Form::submit('Submit') }}
    {{ Form::close() }}
@stop
