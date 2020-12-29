{{-- Anonymous Component --}}
@props(['post' => $post])
    <div class="mb-4">
        <a href="{{ route('users.posts', $post->user) }} " class=font-bold>{{ $post->user->username }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
        <p class="mb-2">{{ $post->body }}</p>
        {{-- Check if post is owned by logged in user before showing a delete button --}}
        {{-- @if ($post->ownedBy(auth()->user())) --}}
            @can('delete', $post)
                {{-- Delete Post --}}
                <form action="{{ route('posts.destroy', $post) }}" method="post" class="mr-2">
                    @csrf
                    {{-- Use Method Spoofing in order to enforce delete method--}}
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">Delete</button>
                </form>
            @endcan
        {{-- @endif --}}
        {{-- Like/Unlike Post --}}
        <div class="flex items-center">
            {{-- Check if user is signed in with @auth  --}}
            @auth
                @if (!$post->likedBy(auth()->user()))
                    <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-2">
                        @csrf
                        <button type="submit" class="text-blue-500">Like</button>
                    </form>
                @else
                    <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-2">
                        @csrf
                        {{-- Because this is the same action route as a Like above we need ot use Method Spoofing in order to enforce delete method--}}
                        @method('DELETE')
                        <button type="submit" class="text-blue-500">Unlike</button>
                    </form>
                @endif
                
            @endauth
            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }} </span>
        </div>
    </div>
