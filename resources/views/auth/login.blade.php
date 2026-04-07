<x-guest-layout>
    <div class="auth-background min-h-screen w-full flex flex-col items-center justify-center p-6">
        
        <div class="mb-8">
            <a href="/">
                <img src="{{ asset('image/TechHub_Admin_Logo.png') }}" class="logo-size mx-auto" alt="Logo" width="250" height="75">
            </a>
        </div>

        <div class="login-card">
            <h2 class="text-white text-center text-xl mb-1">Welcome Back!</h2><br>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" placeholder="username@gmail.com" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Password" required>
                </div>

                <div class="text-right mb-6">
                    <a href="{{ route('password.request') }}" class="text-xs text-gray-400 hover-link">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-primary btn-glow">
                    Login
                </button>
                
                <div class="mt-8 text-center text-xs text-gray-500">
                    Don't have an account yet? 
                    <a href="{{ route('register') }}" class="text-white underline hover-link">Register for free</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>