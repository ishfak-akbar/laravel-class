<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">All Posts</h1>
                        <a href="{{ route('posts.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create New Post
                        </a>
                    </div>

                    @if($posts->count() > 0)
                        <div class="space-y-6">
                            @foreach($posts as $post)
                                <div class="border border-gray-200 rounded-lg p-6 shadow-sm">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center font-bold">
                                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h3 class="font-semibold">{{ $post->user->name }}</h3>
                                                <p class="text-sm text-gray-500">{{ $post->created_at->format('M j, Y g:i A') }}</p>
                                            </div>
                                        </div>
                                        
                                        @if($post->user_id == Auth::id())
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-800 font-medium"
                                                        onclick="return confirm('Are you sure you want to delete this post?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>

                                    <div class="mb-4">
                                        <p class="text-gray-800 whitespace-pre-line">{{ $post->content }}</p>
                                    </div>

                                    @if($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" 
                                            alt="Post image" 
                                            class="rounded-lg max-w-full h-auto max-h-96 object-cover">
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg">No posts yet. Be the first to share something!</p>
                            <a href="{{ route('posts.create') }}" 
                               class="inline-block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Your First Post
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>