<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationBell extends Component
{
    public $notifications;
    public $unreadCount;

    public function mount()
    {
        $this->refreshNotifications();
    }

    public function refreshNotifications()
    {
        $user = auth()->user();
        if ($user) {
            $this->notifications = $user->notifications()->limit(10)->get();
            $this->unreadCount = $user->unreadNotifications->count();
        } else {
            $this->notifications = collect();
            $this->unreadCount = 0;
        }
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
        }
        
        // Redirect if URL exists
        if (isset($notification->data['url'])) {
            return redirect($notification->data['url']);
        }

        $this->refreshNotifications();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->refreshNotifications();
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
