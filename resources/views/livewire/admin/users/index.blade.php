<div>
    <div class="top-bar">
        <div class="page-title">
            <h1>User Management</h1>
            <p>Kelola semua pelanggan dan admin yang terdaftar.</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div style="background: rgba(34,197,94,0.15); color: #22C55E; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid rgba(34,197,94,0.2);">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div style="background: rgba(239,68,68,0.15); color: #EF4444; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid rgba(239,68,68,0.2);">
            {{ session('error') }}
        </div>
    @endif

    <div class="admin-card">
        <div style="margin-bottom: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 250px; position: relative;">
                <input type="text" wire:model.live="search" class="form-input" placeholder="Cari nama atau email user..." style="padding-left: 2.75rem;">
                <svg style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: rgba(255,255,255,0.4);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <div style="overflow-x: auto; margin: 0 -1.5rem; padding: 0 1.5rem;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined Date</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 35px; height: 35px; border-radius: 8px; background: linear-gradient(135deg, #FF7A00, #FF9F43); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div style="font-weight: 600;">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge badge-warning">ADMIN</span>
                                @else
                                    <span class="badge" style="background: rgba(59, 130, 246, 0.15); color: #3B82F6;">CUSTOMER</span>
                                @endif
                            </td>
                            <td style="color: rgba(255,255,255,0.5);">{{ $user->created_at->format('d M Y') }}</td>
                            <td style="text-align: right;">
                                @if($user->id !== auth()->id())
                                    <button onclick="confirm('Apakah Anda yakin ingin menghapus user ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $user->id }})" class="link-delete" title="Delete User">
                                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 3rem; color: rgba(255,255,255,0.4);">
                                Tidak ada user ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 1.5rem;">
            {{ $users->links() }}
        </div>
    </div>
</div>
