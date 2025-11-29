<x-app-layout>
    <div class="posts-container">
        <div class="page-header">
            <h2 class="all-posts">All Posts</h2>
            <a href="{{ route('posts.create') }}" class="btn">Create New Post</a>
        </div>

        <div class="posts-list">
            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <div class="post">
                        <div class="post-header">
                            <div class="user-info">
                                <div class="avatar-circle small">
                                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                </div>
                                <div class="user-details">
                                    <div class="post-user">{{ $post->user->name }}</div>
                                    <div class="post-date">{{ $post->created_at->format('M j, Y g:i A') }}</div>
                                </div>
                            </div>
                            @if($post->user_id == Auth::id())
                                <div class="post-actions">
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete-btn" onclick="return confirm('Are you sure you want to delete this post?')">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <div class="post-content">
                            <p>{{ nl2br(e($post->content)) }}</p>
                            @if($post->image)
                                <div class="post-image">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post image">
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div style="text-align: center; margin-top: 30px;">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="no-posts">
                    <p class="noposts">No posts yet. Be the first to share something!</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>