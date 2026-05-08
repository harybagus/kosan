<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'name',
        'email',
        'phone',
        'id_card_number',
        'id_card_image',
        'start_date',
        'end_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    // =========================================================
    // AUTO UPDATE ROOM STATUS
    // =========================================================
    protected static function booted(): void
    {
        // Saat tenant dihapus, bebaskan kamarnya
        static::deleted(function (Tenant $tenant) {
            if ($tenant->room_id) {
                $stillOccupied = static::where('room_id', $tenant->room_id)
                    ->where('status', 'active')
                    ->exists();

                Room::where('id', $tenant->room_id)
                    ->update(['status' => $stillOccupied ? 'occupied' : 'available']);
            }
        });
    }

    // =========================================================
    // RELATIONS
    // =========================================================
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function notifications()
    {
        return $this->hasMany(KosNotification::class, 'related_tenant_id');
    }

    // =========================================================
    // HELPERS
    // =========================================================
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function getDurationAttribute(): string
    {
        $start = $this->start_date;
        $end   = $this->end_date ?? now();
        $months = $start->diffInMonths($end);
        $days   = $start->diffInDays($end) % 30;

        if ($months > 0) {
            return $months . ' bulan' . ($days > 0 ? ' ' . $days . ' hari' : '');
        }

        return $days . ' hari';
    }
}
