<div class="p-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Category</h2>
            <p class="text-gray-600">Modify category details.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" 
           class="text-indigo-600 hover:text-indigo-900 font-medium flex items-center gap-1 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Categories
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
        <form wire:submit="update" class="p-6 space-y-6">
            <div class="grid grid-cols-1 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input wire:model.live="name" type="text" id="name" 
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all @error('name') border-red-500 @enderror"
                           placeholder="e.g. Sushi Rolls">
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                    <input wire:model="slug" type="text" id="slug" 
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all @error('slug') border-red-500 @enderror"
                           readonly>
                    @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Icon -->
                <div>
                    <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon (HTML/SVG or Emoji)</label>
                    <input wire:model="icon" type="text" id="icon" 
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all @error('icon') border-red-500 @enderror"
                           placeholder="e.g. 🍣 or SVG code">
                    @error('icon') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea wire:model="description" id="description" rows="3"
                              class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all @error('description') border-red-500 @enderror"
                              placeholder="Describe this category..."></textarea>
                    @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Is Active -->
                <div class="flex items-center gap-2">
                    <input wire:model="is_active" type="checkbox" id="is_active" 
                           class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    <label for="is_active" class="text-sm font-medium text-gray-700">Active Status</label>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.categories.index') }}" 
                   class="px-6 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 font-medium transition-all">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-all flex items-center gap-2">
                    <span wire:loading.remove>Update Category</span>
                    <span wire:loading font-bold font-bold font-bold>Updating...</span>
                </button>
            </div>
        </form>
    </div>
</div>
