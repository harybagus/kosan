<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'room_id',
        'amount',
        'due_date',
        'paid_date',
        'status',
        'payment_method',
        'proof_image',
        'notes',
    ];

    protected $casts = [
        'due_date'  => 'date',
        'paid_date' => 'date',
        'amount'    => 'decimal:2',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function notification()
    {
        return $this->hasOne(KosNotification::class, 'related_payment_id');
    }

    public function computeStatus(): string
    {
        if ($this->status === 'paid') return 'paid';

        $diff = Carbon::today()->diffInDays(Carbon::parse($this->due_date), false);

        if ($diff <= -1) return 'overdue';
        if ($diff <= 3)  return 'due_soon';
        return 'pending';
    }

    public function isDueSoon(): bool
    {
        return $this->status === 'due_soon';
    }
    public function isOverdue(): bool
    {
        return $this->status === 'overdue';
    }
    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }
}
