<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

#[Layout('components.admin-layout')]
class Edit extends Component
{
    use WithFileUploads;

    public $product_id;
    public $product;
    public $category_id;
    public $name;
    public $description;
    public $price;
    public $new_image;
    public $stock;
    public $is_featured;
    public $is_active;

    public function mount($id)
    {
        $this->product_id = $id;
        $this->product = Product::findOrFail($id);
        $this->category_id = $this->product->category_id;
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->stock = $this->product->stock;
        $this->is_featured = $this->product->is_featured;
        $this->is_active = $this->product->is_active;
    }

    protected function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|min:3',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'new_image' => 'nullable|image|max:2048',
            'stock' => 'required|integer|min:0',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
        ];

        if ($this->new_image) {
            if (!str_contains($this->product->image, 'images/products/')) {
                $oldPath = str_replace('storage/', '', $this->product->image);
                Storage::disk('public')->delete($oldPath);
            }
            
            $imagePath = $this->new_image->store('products', 'public');
            $data['image'] = 'storage/' . $imagePath;
        }

        $this->product->update($data);

        session()->flash('message', 'Product updated successfully.');
        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.edit', [
            'categories' => Category::all(),
        ]);
    }
}
