<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Notifications\PromotionBroadcastNotification;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Notification;

#[Layout('components.admin-layout')]
class Broadcast extends Component
{
    use WithFileUploads;

    public $title = '';
    public $body = '';
    public $target = 'all_customers'; // all_customers, all_users
    public $actionUrl = '';
    public $image;

    protected $rules = [
        'title' => 'required|min:5',
        'body' => 'required|min:10',
        'target' => 'required',
        'image' => 'nullable|image|max:2048', // 2MB Max
    ];

    public function send()
    {
        $this->validate();

        $usersQuery = User::query();

        if ($this->target === 'all_customers') {
            $usersQuery->where('role', 'customer');
        }

        // Only send to verified users if verification is required
        $users = $usersQuery->whereNotNull('email_verified_at')->get();

        if ($users->isEmpty()) {
            session()->flash('error', 'No verified users found for this target.');
            return;
        }

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('promotions', 'public');
        }

        Notification::send($users, new PromotionBroadcastNotification(
            $this->title, 
            $this->body, 
            $this->actionUrl,
            $imagePath
        ));

        session()->flash('success', 'Promotion broadcast sent to ' . $users->count() . ' users!');
        
        $this->reset(['title', 'body', 'actionUrl', 'image']);
    }

    public function render()
    {
        return view('livewire.admin.broadcast');
    }
}
