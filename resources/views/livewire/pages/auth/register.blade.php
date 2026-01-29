<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('verification.notice', absolute: false), navigate: true);
    }
}; ?>

<div style="position: relative;">
    {{-- Loading Overlay --}}
    <div wire:loading wire:target="register" class="auth-loading-overlay">
        <div class="loader-v5"></div>
        <div class="loading-text">Preparing your journey...</div>
    </div>

    <h2 class="auth-title">Create Account</h2>
    <p class="auth-subtitle">Join us for the ultimate sushi experience</p>

    <form wire:submit="register">
        <!-- Name -->
        <div class="form-group">
            <label class="form-label" for="name">Full Name</label>
            <input wire:model="name" id="name" class="form-input" type="text" name="name" required autofocus placeholder="John Doe" />
            @error('name') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input wire:model="email" id="email" class="form-input" type="email" name="email" required placeholder="your@email.com" />
            @error('email') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input wire:model="password" id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            @error('password') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label class="form-label" for="password_confirmation">Confirm Password</label>
            <input wire:model="password_confirmation" id="password_confirmation" class="form-input" type="password" name="password_confirmation" required placeholder="••••••••" />
            @error('password_confirmation') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-auth" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="register">Create Account</span>
            <span wire:loading wire:target="register">Creating Account...</span>
        </button>
    </form>

    <div class="auth-footer">
        Already have an account? <a href="{{ route('login') }}" wire:navigate>Sign In</a>
    </div>
</div>
