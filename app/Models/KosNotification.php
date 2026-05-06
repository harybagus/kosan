<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KosNotification extends Model
{
    use HasFactory;

    protected $table = 'kos_notifications';

    protected $fillable = [
        'title',
        'message',
        'type',
        'icon',
        'related_payment_id',
        'related_tenant_id',
        'read_at',
    ];

    protected $casts = ['read_at' => 'datetime'];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'related_payment_id');
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'related_tenant_id');
    }
    public function isRead(): bool
    {
        return $this->read_at !== null;
    }
    public function markAsRead(): void
    {
        $this->update(['read_at' => now()]);
    }
}
