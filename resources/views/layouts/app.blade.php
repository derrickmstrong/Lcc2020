<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Posty</title>
</head>
<body class="bg-gray-100">
    <nav class="p-6 mb-6 bg-white flex justify-between">
        <ul class="flex items-center">
            <li><a href="{{ route('home') }}" class="p-3">Home</a></li>
            <li><a href="{{ route('dashboard') }}" class="p-3">Dashboard</a></li>
            <li><a href="{{ route('posts') }}" class="p-3">Post</a></li>
        </ul>
        <ul class="flex items-center">
            {{-- V1: Check if user is logged in using if/else --}}
            {{-- @if (auth()->user())
                <li><a href="" class="p-3">Derrick Strong</a></li>
                <li><a href="" class="p-3">Logout</a></li>
            @else
                <li><a href="" class="p-3">Login</a></li>
                <li><a href="{{ route('register')}}" class="p-3">Register</a></li>
            @endif --}}

            {{-- V2: Better solution to check if user is logged in --}}
             @auth
                <li><a href="" class="p-3">{{ auth()->user()->name}}</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="post" class="inline">
                        @csrf
                        <button type="submit" class="p-3">Logout</button>
                    </form>
                </li>
            @endauth
            @guest
                <li><a href="{{ route('login')}}" class="p-3">Login</a></li>
                <li><a href="{{ route('register')}}" class="p-3">Register</a></li>
            @endguest
        </ul>
    </nav>
    @yield('content')
</body>
</html>