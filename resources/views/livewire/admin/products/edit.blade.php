<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex items-center mb-6">
                <a href="{{ route('admin.products.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-800">Edit Produk: {{ $product->name }}</h2>
            </div>

            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input wire:model="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select wire:model="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea wire:model="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50"></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                        <input wire:model="price" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                        @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Stok</label>
                        <input wire:model="stock" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                        @error('stock') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ubah Gambar Produk (Opsional)</label>
                        <input wire:model="new_image" type="file" class="mt-1 block w-full">
                        @error('new_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        
                        <div class="mt-2 flex gap-4">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Gambar Saat Ini:</p>
                                <img src="{{ asset($product->image) }}" class="h-32 w-32 object-cover rounded-lg border">
                            </div>
                            @if ($new_image)
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Preview Baru:</p>
                                    <img src="{{ $new_image->temporaryUrl() }}" class="h-32 w-32 object-cover rounded-lg border border-orange-400">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center">
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model="is_featured" class="rounded border-gray-300 text-orange-600 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-600">Produk Unggulan (Featured)</span>
                        </label>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-orange-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-orange-700 active:bg-orange-800 transition ease-in-out duration-150">
                        Perbarui Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
