<div>
    <div class="top-bar">
        <div class="page-title">
            <h1>Edit Product</h1>
            <p>Update product: {{ $product->name }}</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn-secondary">
            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Products
        </a>
    </div>

    <div class="admin-card">
        <form wire:submit.prevent="save">
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                <!-- Name -->
                <div>
                    <label class="form-label">Product Name</label>
                    <input wire:model="name" type="text" class="form-input" placeholder="e.g. Salmon Nigiri">
                    @error('name') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <!-- Category -->
                <div>
                    <label class="form-label">Category</label>
                    <select wire:model="category_id" class="form-input" style="cursor: pointer;">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div style="grid-column: span 2;">
                    <label class="form-label">Description</label>
                    <textarea wire:model="description" rows="4" class="form-input" placeholder="Describe your product..."></textarea>
                    @error('description') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <!-- Price -->
                <div>
                    <label class="form-label">Price (Rp)</label>
                    <input wire:model="price" type="number" class="form-input" placeholder="e.g. 35000">
                    @error('price') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label class="form-label">Stock</label>
                    <input wire:model="stock" type="number" class="form-input" placeholder="e.g. 100">
                    @error('stock') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <!-- Image Upload -->
                <div style="grid-column: span 2;">
                    <label class="form-label">Product Image</label>
                    <div style="display: flex; gap: 1.5rem; align-items: flex-start;">
                        <!-- Current Image -->
                        <div style="flex-shrink: 0;">
                            <p style="color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 0.5rem;">Current:</p>
                            <img src="{{ asset($product->image ?? 'images/placeholder.png') }}" style="width: 100px; height: 100px; border-radius: 12px; object-fit: cover; border: 2px solid rgba(255,255,255,0.1);">
                        </div>

                        <!-- Upload New -->
                        <div style="flex: 1;">
                            <p style="color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 0.5rem;">Upload New (Optional):</p>
                            <div style="border: 2px dashed rgba(255,255,255,0.1); border-radius: 12px; padding: 1.5rem; text-align: center; cursor: pointer; height: 100px; display: flex; align-items: center; justify-content: center;" 
                                 onclick="document.getElementById('newImageInput').click()">
                                @if ($new_image)
                                    <img src="{{ $new_image->temporaryUrl() }}" style="max-height: 80px; border-radius: 8px;">
                                @else
                                    <p style="color: rgba(255,255,255,0.4); font-size: 0.85rem;">Click to upload</p>
                                @endif
                                <input wire:model="new_image" type="file" id="newImageInput" style="display: none;" accept="image/*">
                            </div>
                        </div>
                    </div>
                    @error('new_image') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <!-- Options -->
                <div style="grid-column: span 2; display: flex; gap: 2rem;">
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                        <input type="checkbox" wire:model="is_featured" style="width: 20px; height: 20px; accent-color: #FF7A00;">
                        <span style="color: rgba(255,255,255,0.8);">Featured Product</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                        <input type="checkbox" wire:model="is_active" style="width: 20px; height: 20px; accent-color: #FF7A00;">
                        <span style="color: rgba(255,255,255,0.8);">Active (Visible in store)</span>
                    </label>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: flex-end; gap: 1rem;">
                <a href="{{ route('admin.products.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">
                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
