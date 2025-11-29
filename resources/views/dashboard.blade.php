<x-app-layout>
    <div class="dashboard">
        <div class="welcome-section">
            <div class="avatar-circle large">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="welcome-text">
                <h2>Welcome, {{ Auth::user()->name }} <span class="you-text">(You)</span></h2>
                <p class="email">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <h3>Total Posts</h3>
                <div class="stat-number">{{ Auth::user()->posts->count() }}</div>
                <p class="stat-description">Posts you've created</p>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <h3>Friends</h3>
                <div class="stat-number">0</div>
                <p class="stat-description">Friends you've made</p>
            </div>
        </div>

        <div class="empty-state">
            <div class="empty-icon">📝</div>
            <form method="POST" action="{{ route('posts.store') }}" class="direct-post-form">
                @csrf
                <textarea name="content" placeholder="What's on your mind?" rows="3" maxlength="255" required></textarea>
                <button type="submit" class="btn">Create Post</button>
            </form>
        </div>
    </div>
</x-app-layout>