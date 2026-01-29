<div>
    <div class="top-bar">
        <div class="page-title">
            <h1>Categories</h1>
            <p>Manage your product categories</p>
        </div>
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
    </div>

    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; gap: 1rem; flex-wrap: wrap;">
            <div class="search-wrapper">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search categories..." class="form-input">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="btn-primary">
                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Category
            </a>
        </div>

        @if (session('success'))
            <div style="background: rgba(34,197,94,0.15); border-left: 4px solid #22C55E; color: #22C55E; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background: rgba(239,68,68,0.15); border-left: 4px solid #EF4444; color: #EF4444; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                {{ session('error') }}
            </div>
        @endif

        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 45px; height: 45px; background: rgba(255,122,0,0.1); border-radius: 12px;">
                                <x-category-icon :slug="$category->slug" size="24" />
                            </span>
                        </td>

                        <td>
                            <div style="font-weight: 600;">{{ $category->name }}</div>
                            <div style="color: rgba(255,255,255,0.5); font-size: 0.8rem;">{{ Str::limit($category->description, 50) }}</div>
                        </td>
                        <td>
                            <span style="background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.6); padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.8rem; font-family: monospace;">
                                {{ $category->slug }}
                            </span>
                        </td>
                        <td>
                            <span style="font-weight: 600;">{{ $category->products_count }}</span>
                            <span style="color: rgba(255,255,255,0.5);"> items</span>
                        </td>
                        <td>
                            @if($category->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="link-edit" style="margin-right: 1rem;">Edit</a>
                            <button wire:click="delete({{ $category->id }})" wire:confirm="Are you sure you want to delete this category?" class="link-delete">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: rgba(255,255,255,0.5); padding: 3rem;">
                            No categories found. Create your first category!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

        @if($categories->hasPages())
            <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.05);">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
