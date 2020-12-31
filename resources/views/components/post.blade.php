{{-- Anonymous Component --}}
@props(['post' => $post])
    <div class="mb-4">
        <a href="{{ route('users.posts', $post->user) }} " class=font-bold>{{ $post->user->username }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
        <p class="mb-2">{{ $post->body }}</p>
        <div class="flex items-center">
            {{-- Like/Unlike Post --}}
            {{-- Check if user is signed in with @auth  --}}
            @auth
                @if (!$post->likedBy(auth()->user()))
                    <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-2">
                        @csrf
                        <button type="submit" class="text-blue-500">👍🏾</button>
                    </form>
                @else
                    <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-2">
                        @csrf
                        {{-- Because this is the same action route as a Like above we need ot use Method Spoofing in order to enforce delete method--}}
                        @method('DELETE')
                        <button type="submit" class="text-blue-500">👎🏾</button>
                    </form>
                @endif
            @endauth
            <span class="mr-10">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }} </span>
            {{-- Check if post is owned by logged in user before showing a delete button --}}
            {{-- @if ($post->ownedBy(auth()->user())) --}}
            @can('delete', $post)
                {{-- Delete Post --}}
                <form action="{{ route('posts.destroy', $post) }}" method="post" class="mr-2">
                    @csrf
                    {{-- Use Method Spoofing in order to enforce delete method--}}
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">🗑️</button>
                </form>
            @endcan
            {{-- @endif --}}
        </div>
    </div>
