<x-app-layout>
    <div class="box">
        <div class="auth-header">
            <h2>Create Account</h2>
            <p class="auth-subtitle">Join our community today</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="form">
            @csrf

            <!-- Name -->
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit">Register</button>

            <p class="auth-link">
                Have an account? <a href="{{ route('login') }}">Login</a>
            </p>
        </form>
    </div>
</x-app-layout>