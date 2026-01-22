<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $selectedCategory = null;
    public $search = '';
    public $sort = 'latest';

    protected $queryString = [
        'selectedCategory' => ['except' => null, 'as' => 'category'],
        'search' => ['except' => ''],
        'sort' => ['except' => 'latest'],
    ];

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['selectedCategory', 'search', 'sort']);
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::withCount('products')->get();
        
        $query = Product::where('is_active', true);

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        switch ($this->sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12);

        return view('livewire.product-list', [
            'products' => $products,
            'categories' => $categories,
        ])->layout('layouts.store', ['title' => 'Our Menu - Sushi Ecommerce']);
    }
}
