<?php

namespace App\Livewire;

use App\Models\KosNotification;
use Livewire\Component;

class NotificationBell extends Component
{
    public bool $open = false;

    // Refresh otomatis setiap 30 detik
    protected $listeners = ['refreshNotifications' => '$refresh'];

    public function getUnreadCountProperty(): int
    {
        return KosNotification::whereNull('read_at')->count();
    }

    public function getNotificationsProperty()
    {
        return KosNotification::with(['tenant'])
            ->whereNull('read_at')
            ->orderByRaw("FIELD(type, 'danger', 'warning', 'info')")
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();
    }

    public function toggle(): void
    {
        $this->open = !$this->open;
    }

    public function markAsRead(int $id): void
    {
        KosNotification::find($id)?->markAsRead();
    }

    public function markAllAsRead(): void
    {
        KosNotification::whereNull('read_at')->update(['read_at' => now()]);
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
