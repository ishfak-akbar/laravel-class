<x-app-layout>
    <div class="box">
        <div class="auth-header">
            <h2>Sign In</h2>
            <p class="auth-subtitle">Welcome back to AuthBoard</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="form">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div style="margin-bottom: 20px;">
                <label for="remember_me" style="display: flex; align-items: center; gap: 8px;">
                    <input id="remember_me" type="checkbox" name="remember" style="width: auto;">
                    <span style="font-size: 14px; color: #666;">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center;">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="font-size: 14px; color: #2575fc; text-decoration: none;">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" style="width: auto; padding: 12px 30px;">
                    {{ __('Log in') }}
                </button>
            </div>

            <p class="auth-link">
                Don't have an account? <a href="{{ route('register') }}">Sign up</a>
            </p>
        </form>
    </div>
</x-app-layout>