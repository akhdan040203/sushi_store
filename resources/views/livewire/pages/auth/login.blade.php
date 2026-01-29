<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        if (! auth()->user()->hasVerifiedEmail()) {
            $this->redirect(route('verification.notice', absolute: false), navigate: true);
            return;
        }

        if (auth()->user()->isAdmin()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        } else {
            $this->redirectIntended(default: url('/'), navigate: true);
        }
    }
}; ?>

<div style="position: relative;">
    {{-- Loading Overlay --}}
    <div wire:loading wire:target="login" class="auth-loading-overlay">
        <div class="loader-v5"></div>
        <div class="loading-text">Authenticating...</div>
    </div>

    <h2 class="auth-title">Welcome Back</h2>
    <p class="auth-subtitle">Please enter your details to login</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input wire:model="form.email" id="email" class="form-input" type="email" name="email" required autofocus placeholder="your@email.com" />
            @error('form.email') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <label class="form-label" style="margin-bottom: 0;" for="password">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-sm" style="color: rgba(255,255,255,0.4); text-decoration: none;" href="{{ route('password.request') }}" wire:navigate>
                        Forgot password?
                    </a>
                @endif
            </div>
            <input wire:model="form.password" id="password" class="form-input" type="password" name="password" required placeholder="••••••••" />
            @error('form.password') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center" style="cursor: pointer;">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember" style="accent-color: #FF7A00;">
                <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <button type="submit" class="btn-auth">
            Sign In
        </button>
    </form>

    <div class="auth-footer">
        Don't have an account? <a href="{{ route('register') }}" wire:navigate>Sign Up Now</a>
    </div>
</div>
