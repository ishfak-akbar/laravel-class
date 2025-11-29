<x-app-layout>
    <div class="box">
        <div class="auth-header">
            <h2>Create New Post</h2>
            <p class="auth-subtitle">Share something with the community</p>
        </div>

        <form method="POST" action="{{ route('posts.store') }}" class="form" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="content">What's on your mind?</label>
                <textarea id="content" name="content" rows="4" placeholder="Share your thoughts..." required autofocus>{{ old('content') }}</textarea>
                @error('content')
                    <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="image">Add an image (optional)</label>
                <input type="file" id="image" name="image" accept="image/*">
                @error('image')
                    <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 15px;">
                <a href="{{ route('posts.index') }}" class="btn" style="background: #666; text-align: center;">Cancel</a>
                <button type="submit">Create Post</button>
            </div>
        </form>
    </div>
</x-app-layout>