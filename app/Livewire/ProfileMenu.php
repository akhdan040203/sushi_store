<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileMenu extends Component
{
    public function logout(Logout $logout)
    {
        $logout();
        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.profile-menu');
    }
}
