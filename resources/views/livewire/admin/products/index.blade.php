<div>
    <div class="top-bar">
        <div class="page-title">
            <h1>Products</h1>
            <p>Manage your sushi products inventory</p>
        </div>
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
    </div>

    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <div style="position: relative; width: 300px;">
                <input wire:model.live="search" type="text" placeholder="Search products..." class="form-input" style="padding-left: 2.5rem;">
                <svg style="position: absolute; left: 0.875rem; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: rgba(255,255,255,0.4);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn-primary">
                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Product
            </a>
        </div>

        @if (session()->has('message'))
            <div style="background: rgba(34,197,94,0.15); border-left: 4px solid #22C55E; color: #22C55E; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                {{ session('message') }}
            </div>
        @endif

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset($product->image ?? 'images/placeholder.png') }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; border-radius: 10px; object-fit: cover;">
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $product->name }}</div>
                            <div style="color: rgba(255,255,255,0.5); font-size: 0.8rem;">{{ Str::limit($product->description, 40) }}</div>
                        </td>
                        <td>
                            <span style="background: rgba(255,122,0,0.15); color: #FF7A00; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem;">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #22C55E;">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </td>
                        <td>
                            @if($product->stock < 10)
                                <span class="badge badge-danger">{{ $product->stock }} left</span>
                            @else
                                <span class="badge badge-success">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td>
                            @if($product->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="link-edit" style="margin-right: 1rem;">Edit</a>
                            <button wire:click="delete({{ $product->id }})" wire:confirm="Are you sure you want to delete this product?" class="link-delete">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: rgba(255,255,255,0.5); padding: 3rem;">
                            No products found. Create your first product!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($products->hasPages())
            <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.05);">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
