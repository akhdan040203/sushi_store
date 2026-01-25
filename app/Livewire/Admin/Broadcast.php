<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Notifications\PromotionBroadcastNotification;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Notification;

#[Layout('components.admin-layout')]
class Broadcast extends Component
{
    public $title = '';
    public $body = '';
    public $target = 'all_customers'; // all_customers, all_users
    public $actionUrl = '';

    protected $rules = [
        'title' => 'required|min:5',
        'body' => 'required|min:10',
        'target' => 'required',
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

        Notification::send($users, new PromotionBroadcastNotification($this->title, $this->body, $this->actionUrl));

        session()->flash('success', 'Promotion broadcast sent to ' . $users->count() . ' users!');
        
        $this->reset(['title', 'body', 'actionUrl']);
    }

    public function render()
    {
        return view('livewire.admin.broadcast');
    }
}
