<x-guest-layout>
    <div class="auth-background min-h-screen w-full flex flex-col items-center justify-center p-6">
        
        <div class="mb-8">
            <a href="/">
                <img src="{{ asset('image/TechHub_Admin_Logo.png') }}" class="logo-size mx-auto" alt="Logo" width="250" height="75">
            </a>
        </div>

        <div class="login-card">
            <h2 class="text-center text-white text-xl mb-1">Welcome!</h2><br>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-input" placeholder="Enter your name" :value="old('name')" required autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" placeholder="username@gmail.com" :value="old('email')" required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Create a password" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Repeat password" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="btn-primary btn-glow">
                    {{ __('Register') }}
                </button>
                
                <div class="mt-8 text-center text-xs text-gray-500">
                    {{ __('Already have an account?') }} 
                    <a href="{{ route('login') }}" class="text-white underline hover-link">Login</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>