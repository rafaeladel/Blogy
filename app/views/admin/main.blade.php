@extends('layout.layout')

@section('header')

@stop

@section('content')
<h2>Main - Admin</h2>
<ul>
    <li>{{ link_to('admin/post/list/', 'List Posts') }}</li>
    <li><a href="action(Admin@logout)">Logout</a></li>
</ul>
@stop