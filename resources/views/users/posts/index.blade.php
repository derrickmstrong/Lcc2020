@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="p-6">
                <h1 class="text-2xl font-meduim mb-3">{{ $user->name }}</h1>
                {{-- <p>Total {{ Str::plural('Post', $posts->count()) }}: {{ $posts->count() }}</p> --}}
                <p>Total {{ Str::plural('like', $user->totalLikes->count()) }}: {{ $user->totalLikes->count()}} </p>
            </div>
            <div class=" bg-white p-6 rounded-lg">
           @if ($posts->count())
                @foreach ($posts as $post)
                    {{-- Use post component here --}}
                    <div class="my-1 mb-4"><x-post :post="$post" /></div>
                @endforeach
                {{ $posts->links() }}
            @else
                <p class="my-5">{{ $user->name }} doesn't have any post!</p>
            @endif
            </div>
        </div>
    </div>
@endsection