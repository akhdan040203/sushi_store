<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class NavbarSearch extends Component
{
    public $search = '';
    public $results = [];

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $this->results = Product::where('name', 'like', '%' . $this->search . '%')
                ->limit(5)
                ->get();
        } else {
            $this->results = [];
        }
    }

    public function render()
    {
        return view('livewire.navbar-search');
    }
}
