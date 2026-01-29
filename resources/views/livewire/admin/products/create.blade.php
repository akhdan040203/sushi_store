<div>
    <div class="top-bar">
        <div class="page-title">
            <h1>Add New Product</h1>
            <p>Create a new sushi product for your store</p>
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
                <div>
                    <label class="form-label">Product Image <small style="color: rgba(255,255,255,0.4); font-weight: normal;">(Max 2MB)</small></label>
                    <div style="border: 2px dashed rgba(255,255,255,0.1); border-radius: 12px; padding: 2rem; text-align: center; transition: all 0.2s; cursor: pointer; position: relative; background: rgba(255,255,255,0.02);" 
                         onclick="document.getElementById('imageInput').click()"
                         onmouseover="this.style.borderColor='rgba(255,122,0,0.5)'; this.style.background='rgba(255,122,0,0.02)'"
                         onmouseout="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.02)'">
                        
                        <div wire:loading wire:target="image" style="position: absolute; inset: 0; background: rgba(0,0,0,0.7); display: flex; align-items: center; justify-content: center; border-radius: 12px; z-index: 10;">
                            <div style="color: white; font-size: 0.9rem;">Uploading...</div>
                        </div>

                        @if ($image)
                            <div style="position: relative; display: inline-block;">
                                <img src="{{ $image->temporaryUrl() }}" style="max-height: 150px; border-radius: 12px; box-shadow: 0 10px 20px rgba(0,0,0,0.2);">
                                <div style="margin-top: 0.75rem; color: #FF7A00; font-size: 0.85rem; font-weight: 600;">Image Selected</div>
                            </div>
                        @else
                            <svg style="width: 48px; height: 48px; color: rgba(255,255,255,0.2); margin: 0 auto 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p style="color: rgba(255,255,255,0.4); font-size: 0.9rem; margin-bottom: 0.25rem;">Drag & drop or click to upload</p>
                            <p style="color: rgba(255,255,255,0.25); font-size: 0.75rem;">JPG, PNG, WebP up to 2MB</p>
                        @endif
                        <input wire:model="image" type="file" id="imageInput" style="display: none;" accept="image/*">
                    </div>
                    @error('image') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.5rem; display: block; background: rgba(239, 68, 68, 0.1); padding: 0.5rem 1rem; border-radius: 8px;">{{ $message }}</span> @enderror
                </div>

                <!-- Options -->
                <div style="display: flex; flex-direction: column; gap: 1rem; justify-content: center;">
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                        <input type="checkbox" wire:model="is_signature" style="width: 20px; height: 20px; accent-color: #FF7A00;">
                        <span style="color: rgba(255,255,255,0.8);">Recommendation</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                        <input type="checkbox" wire:model="is_active" checked style="width: 20px; height: 20px; accent-color: #FF7A00;">
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
                    Save Product
                </button>
            </div>
        </form>
    </div>
</div>
