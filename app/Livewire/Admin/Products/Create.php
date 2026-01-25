<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

#[Layout('components.admin-layout')]
class Create extends Component
{
    use WithFileUploads;

    public $category_id;
    public $name;
    public $description;
    public $price;
    public $image;
    public $stock = 0;
    public $is_featured = false;
    public $is_active = true;

    protected $rules = [
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|min:3',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'image' => 'required|image|max:2048',
        'stock' => 'required|integer|min:0',
    ];

    public function save()
    {
        $this->validate();

        $imagePath = $this->image->store('products', 'public');

        Product::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'price' => $this->price,
            'image' => 'storage/' . $imagePath,
            'stock' => $this->stock,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
        ]);

        session()->flash('message', 'Product added successfully.');
        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.create', [
            'categories' => Category::all(),
        ]);
    }
}
