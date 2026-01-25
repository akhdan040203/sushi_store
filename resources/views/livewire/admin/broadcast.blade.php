<div>
    <div class="top-bar">
        <div class="page-title">
            <h1>Broadcast Promotion</h1>
            <p>Send special offers or announcements to your customers</p>
        </div>
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
    </div>

    <div class="admin-card" style="max-width: 800px;">
        @if (session()->has('success'))
            <div style="background: rgba(34,197,94,0.15); border-left: 4px solid #22C55E; color: #22C55E; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div style="background: rgba(239,68,68,0.15); border-left: 4px solid #EF4444; color: #EF4444; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="send">
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <!-- Target Segment -->
                <div>
                    <label class="form-label">Send To</label>
                    <select wire:model="target" class="form-input">
                        <option value="all_customers">All Verified Customers</option>
                        <option value="all_users">All Verified Users (Staff & Customers)</option>
                    </select>
                </div>

                <!-- Title -->
                <div>
                    <label class="form-label">Promotion Title</label>
                    <input wire:model="title" type="text" class="form-input" placeholder="e.g. Flash Sale: 50% Off Today!">
                    @error('title') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <!-- Body -->
                <div>
                    <label class="form-label">Message Body</label>
                    <textarea wire:model="body" rows="6" class="form-input" placeholder="Describe your promotion details here..."></textarea>
                    @error('body') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <!-- Action URL (Optional) -->
                <div>
                    <label class="form-label">Action Link (Optional)</label>
                    <input wire:model="actionUrl" type="text" class="form-input" placeholder="/items?category=flash-sale">
                    <p style="color: rgba(255,255,255,0.4); font-size: 0.8rem; margin-top: 0.5rem;">Relative path or full URL where users should be directed</p>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: flex-end;">
                <button type="submit" class="btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Send Broadcast
                    </span>
                    <span wire:loading>Sending to users...</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Preview -->
    <div class="admin-card" style="max-width: 800px; margin-top: 2rem; background: rgba(0,0,0,0.2);">
        <h3 style="margin-bottom: 1rem; color: rgba(255,255,255,0.5); font-size: 0.9rem; text-transform: uppercase;">Email Preview</h3>
        <div style="background: white; color: #1a1a1a; padding: 2rem; border-radius: 12px;">
            <p style="font-weight: 700; color: #FF7A00; margin-bottom: 0.5rem;">Special Promotion for [Customer Name]!</p>
            <h2 style="font-size: 1.5rem; margin-bottom: 1rem;">{{ $title ?: 'Your Title Here' }}</h2>
            <p style="line-height: 1.6; margin-bottom: 1.5rem;">{{ $body ?: 'Your message content will appear here...' }}</p>
            <div style="display: inline-block; background: #FF7A00; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600;">
                {{ $actionUrl ? 'Check Product' : 'Order Now' }}
            </div>
        </div>
    </div>
</div>
