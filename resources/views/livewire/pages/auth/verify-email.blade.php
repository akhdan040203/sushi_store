<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public bool $isVerified = false;

    /**
     * Check if user is verified (for polling).
     */
    public function checkVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->isVerified = true;
            
            // Redirect after 2 seconds to let user see success message
            $this->dispatch('verified-success');
        }
    }

    public function redirectToDashboard(): void
    {
        if (Auth::user()->isAdmin()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        } else {
            $this->redirect(url('/'), navigate: true);
        }
    }

    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->checkVerification();
            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div wire:poll.3s="checkVerification" x-on:verified-success.window="setTimeout(() => $wire.redirectToDashboard(), 2000)">
    <div class="auth-card" style="background: #1a1a1a; padding: 2.5rem; border-radius: 24px; border: 1px solid rgba(255,255,255,0.05); box-shadow: 0 10px 40px rgba(0,0,0,0.4); max-width: 500px; margin: 0 auto; color: white; transition: all 0.5s ease;">
        
        @if(!$isVerified)
            <!-- Verification Form (Original) -->
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="width: 60px; height: 60px; background: rgba(255,122,0,0.1); border-radius: 15px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <svg style="width: 32px; height: 32px; color: #FF7A00;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 style="font-family: 'Cinzel', serif; font-size: 1.75rem; margin-bottom: 0.5rem;">Verify Your Email</h2>
                <p style="color: rgba(255,255,255,0.5); font-size: 0.9rem;">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div style="background: rgba(34,197,94,0.1); border-left: 4px solid #22C55E; color: #22C55E; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.85rem;">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <button wire:click="sendVerification" wire:loading.attr="disabled" style="background: linear-gradient(135deg, #FF7A00, #FF9F43); color: white; padding: 1rem; border-radius: 12px; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s; position: relative;">
                    <span wire:loading.remove wire:target="sendVerification">{{ __('Resend Verification Email') }}</span>
                    <span wire:loading wire:target="sendVerification">{{ __('Sending...') }}</span>
                </button>
            </div>
        @else
            <!-- Success Notification Card -->
            <div style="text-align: center; padding: 1rem 0;">
                <div style="width: 80px; height: 80px; background: rgba(34,197,94,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; color: #22C55E; animation: scaleUp 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                    <svg style="width: 40px; height: 40px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h2 style="font-family: 'Cinzel', serif; font-size: 2rem; margin-bottom: 1rem; color: white;">Success!</h2>
                <p style="color: rgba(255,255,255,0.6); font-size: 1rem; line-height: 1.6; margin-bottom: 2rem;">
                    Your email has been successfully verified.<br>Redirecting you to the store...
                </p>
                <div style="display: flex; justify-content: center;">
                    <div class="loading-dots">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </div>

            <style>
                @keyframes scaleUp {
                    from { transform: scale(0.5); opacity: 0; }
                    to { transform: scale(1); opacity: 1; }
                }
                .loading-dots span {
                    width: 8px;
                    height: 8px;
                    margin: 0 4px;
                    background: #FF7A00;
                    border-radius: 50%;
                    display: inline-block;
                    animation: dots 1.4s infinite ease-in-out both;
                }
                .loading-dots span:nth-child(1) { animation-delay: -0.32s; }
                .loading-dots span:nth-child(2) { animation-delay: -0.16s; }
                @keyframes dots {
                    0%, 80%, 100% { transform: scale(0); opacity: 0.3; }
                    40% { transform: scale(1); opacity: 1; }
                }
            </style>
        @endif
    </div>
</div>
