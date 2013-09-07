<!DOCTYPE html>
<html>
    <head>
        @section('header')
            <link rel='stylesheet' href='www'/>
        @show
    </head>
    <body>
        @yield('content')
        @if(Auth::check())
       		{{ link_to_action('UserController@getLogout', 'Logout')}}
        @endif
    </body>
</html>