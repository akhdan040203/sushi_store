<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;

#[Layout('components.admin-layout')]
class Edit extends Component
{
    public $categoryId;
    public $name;
    public $slug;
    public $icon;
    public $description;
    public $is_active;

    protected $rules = [
        'name' => 'required|min:3',
        'slug' => 'required',
        'icon' => 'nullable',
        'description' => 'nullable',
        'is_active' => 'boolean',
    ];

    public function mount($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->icon = $category->icon;
        $this->description = $category->description;
        $this->is_active = $category->is_active;
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3|unique:categories,name,' . $this->categoryId,
            'slug' => 'required|unique:categories,slug,' . $this->categoryId,
        ]);

        $category = Category::findOrFail($this->categoryId);
        $category->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'description' => $this->description,
            'is_active' => $this->is_active,
        ]);

        session()->flash('success', 'Category updated successfully!');

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.edit');
    }
}
