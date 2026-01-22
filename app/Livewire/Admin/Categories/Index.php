<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    
    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        
        // Prevent deletion if category has products
        if ($category->products()->count() > 0) {
            session()->flash('error', 'Cannot delete category that has products associated with it.');
            return;
        }

        $category->delete();
        session()->flash('success', 'Category deleted successfully.');
    }

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.categories.index', [
            'categories' => $categories
        ])->layout('layouts.app');
    }
}
