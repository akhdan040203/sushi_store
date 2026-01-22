<div class="p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Product Categories</h2>
            <p class="text-gray-600">Manage your product categories here.</p>
        </div>
        <div>
            <a href="{{ route('admin.categories.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-0h6m-6 0H6"/>
                </svg>
                Create Category
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-4 border-b border-gray-100 bg-gray-50/50">
            <div class="relative max-w-sm">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search categories..." 
                       class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 font-semibold text-sm text-gray-700 uppercase tracking-wider">Icon</th>
                        <th class="px-6 py-4 font-semibold text-sm text-gray-700 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 font-semibold text-sm text-gray-700 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-4 font-semibold text-sm text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 font-semibold text-sm text-gray-700 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <span class="p-2 bg-indigo-50 text-indigo-600 rounded-lg inline-block">
                                    {!! $category->icon ?: '📁' !!}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $category->name }}</div>
                                <div class="text-sm text-gray-500 line-clamp-1 max-w-xs">{{ $category->description }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded text-xs font-medium">
                                    {{ $category->slug }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($category->is_active)
                                    <span class="bg-green-100 text-green-700 px-2.5 py-0.5 rounded-full text-xs font-medium">Active</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2.5 py-0.5 rounded-full text-xs font-medium">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 inline-flex items-center gap-1 font-medium transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                    </svg>
                                    Edit
                                </a>
                                <button wire:click="delete({{ $category->id }})" 
                                        wire:confirm="Are you sure you want to delete this category?"
                                        class="text-red-600 hover:text-red-900 inline-flex items-center gap-1 font-medium transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($categories->hasPages())
            <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
