<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        session()->flash('message', 'Produk berhasil dihapus.');
    }

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.products.index', [
            'products' => $products,
        ]);
    }
}
