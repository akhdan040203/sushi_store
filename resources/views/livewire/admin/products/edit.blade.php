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
            <div class="grid-2">
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
                <div class="col-span-2">
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
                <div class="col-span-2">
                    <label class="form-label">Product Image <small style="color: rgba(255,255,255,0.4); font-weight: normal;">(Max 2MB)</small></label>
                    <div style="display: flex; gap: 1.5rem; align-items: flex-start; flex-wrap: wrap;">
                        <!-- Current Image -->
                        <div style="flex-shrink: 0;">
                            <p style="color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 0.5rem;">Current:</p>
                            <img src="{{ $product->image_url }}" style="width: 120px; height: 120px; border-radius: 12px; object-fit: cover; border: 2px solid rgba(255,255,255,0.1); box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
                        </div>

                        <!-- Upload New -->
                        <div style="flex: 1; min-width: 250px;">
                            <p style="color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 0.5rem;">Upload New:</p>
                            <div style="border: 2px dashed rgba(255,255,255,0.1); border-radius: 12px; padding: 1.5rem; text-align: center; cursor: pointer; height: 120px; display: flex; align-items: center; justify-content: center; position: relative; background: rgba(255,255,255,0.02); transition: all 0.2s;" 
                                 onclick="document.getElementById('newImageInput').click()"
                                 onmouseover="this.style.borderColor='rgba(255,122,0,0.5)'; this.style.background='rgba(255,122,0,0.02)'"
                                 onmouseout="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.02)'">
                                
                                <div wire:loading wire:target="new_image" style="position: absolute; inset: 0; background: rgba(0,0,0,0.7); display: flex; align-items: center; justify-content: center; border-radius: 12px; z-index: 10;">
                                    <div style="color: white; font-size: 0.8rem;">Uploading...</div>
                                </div>

                                @if ($new_image)
                                    <div style="text-align: center;">
                                        <img src="{{ $new_image->temporaryUrl() }}" style="max-height: 80px; border-radius: 8px; box-shadow: 0 5px 10px rgba(0,0,0,0.3);">
                                        <div style="color: #FF7A00; font-size: 0.75rem; font-weight: 600; margin-top: 0.5rem;">New Image Ready</div>
                                    </div>
                                @else
                                    <div style="text-align: center;">
                                        <svg style="width: 32px; height: 32px; color: rgba(255,255,255,0.2); margin: 0 auto 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        <p style="color: rgba(255,255,255,0.4); font-size: 0.85rem;">Click to change image</p>
                                    </div>
                                @endif
                                <input wire:model="new_image" type="file" id="newImageInput" style="display: none;" accept="image/*">
                            </div>
                        </div>
                    </div>
                    @error('new_image') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.5rem; display: block; background: rgba(239, 68, 68, 0.1); padding: 0.5rem 1rem; border-radius: 8px;">{{ $message }}</span> @enderror
                </div>

                <!-- Options -->
                <div style="display: flex; flex-direction: column; gap: 1rem; justify-content: center;">
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                        <input type="checkbox" wire:model="is_signature" style="width: 20px; height: 20px; accent-color: #FF7A00;">
                        <span style="color: rgba(255,255,255,0.8);">Recommendation</span>
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
