@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            {{-- Ask user to sign in if not signed in --}}
            @guest
                <p class="mb-7 text-center font-bold">Please sign in to submit post</p>
            @endguest
            {{-- Only show form if user is authenticated --}}
            @auth
                <form action="{{ route('posts') }}" class="mb-6" method="post">
                    {{-- Cross-site Request Forgery --}}
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>
                        
                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                    </div>
                </form>
            @endauth
            {{-- Check for posts --}}
            @if ($posts->count())
                {{-- Loop over post --}}
                @foreach ($posts as $post)
                {{-- Use post component here --}}
                    <x-post :post="$post" />
                @endforeach
                {{-- Display pagination --}}
                    {{ $posts->links() }}
            @else
                <p>No post yet!</p>
            @endif

        </div>
    </div>
@endsection