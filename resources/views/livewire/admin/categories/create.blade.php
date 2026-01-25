<div>
    <div class="top-bar">
        <div class="page-title">
            <h1>Create Category</h1>
            <p>Add a new category for your products</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn-secondary">
            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Categories
        </a>
    </div>

    <div class="admin-card" style="max-width: 600px;">
        <form wire:submit="save">
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <!-- Name -->
                <div>
                    <label class="form-label">Category Name</label>
                    <input wire:model.live="name" type="text" class="form-input" placeholder="e.g. Sushi Rolls">
                    @error('name') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label class="form-label">Slug (Auto-generated)</label>
                    <input wire:model="slug" type="text" class="form-input" style="background: rgba(255,255,255,0.02); color: rgba(255,255,255,0.5);" readonly>
                    @error('slug') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <!-- Icon -->
                <div>
                    <label class="form-label">Icon (Emoji)</label>
                    <input wire:model="icon" type="text" class="form-input" placeholder="e.g. 🍣 or 🍱">
                    <p style="color: rgba(255,255,255,0.4); font-size: 0.8rem; margin-top: 0.5rem;">Use an emoji to represent this category</p>
                    @error('icon') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="form-label">Description</label>
                    <textarea wire:model="description" rows="3" class="form-input" placeholder="Describe this category..."></textarea>
                    @error('description') <span style="color: #EF4444; font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <!-- Is Active -->
                <div>
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                        <input wire:model="is_active" type="checkbox" style="width: 20px; height: 20px; accent-color: #FF7A00;">
                        <span style="color: rgba(255,255,255,0.8);">Active (Visible in store)</span>
                    </label>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: flex-end; gap: 1rem;">
                <a href="{{ route('admin.categories.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">
                    <span wire:loading.remove>
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Create Category
                    </span>
                    <span wire:loading>Creating...</span>
                </button>
            </div>
        </form>
    </div>
</div>
