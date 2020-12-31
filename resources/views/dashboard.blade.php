@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="p-6">
                <h1 class="text-2xl font-meduim mb-3">Dashboard</h1>
            </div>
            <div class="w-8/12 bg-white p-6 rounded-lg">
                <p>{{ auth()->user()->name}}</p>
                <p>@ {{ auth()->user()->username}}</p>
            </div>
        </div>
    </div>
@endsection