<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\KosNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdatePaymentStatus extends Command
{
    protected $signature   = 'payments:update-status';
    protected $description = 'Update status pembayaran otomatis berdasarkan tanggal jatuh tempo';

    public function handle(): void
    {
        $today   = Carbon::today();
        $updated = 0;

        $payments = Payment::where('status', '!=', 'paid')->get();

        foreach ($payments as $payment) {
            $dueDate  = Carbon::parse($payment->due_date);
            $diff     = $today->diffInDays($dueDate, false);
            $oldStatus = $payment->status;
            $newStatus = $oldStatus;

            if ($diff <= -1) {
                $newStatus = 'overdue';
            } elseif ($diff <= 3) {
                $newStatus = 'due_soon';
            } else {
                $newStatus = 'pending';
            }

            // Update hanya jika status berubah
            if ($newStatus !== $oldStatus) {
                $payment->update(['status' => $newStatus]);
                $updated++;

                // Buat notifikasi internal
                $this->createNotification($payment, $newStatus);
            }
        }

        $this->info("✅ Selesai! {$updated} pembayaran diperbarui.");
        $this->table(
            ['Status', 'Jumlah'],
            [
                ['Pending',      Payment::where('status', 'pending')->count()],
                ['Jatuh Tempo',  Payment::where('status', 'due_soon')->count()],
                ['Terlambat',    Payment::where('status', 'overdue')->count()],
                ['Lunas',        Payment::where('status', 'paid')->count()],
            ]
        );
    }

    private function createNotification(Payment $payment, string $newStatus): void
    {
        // Hindari duplikat notifikasi di hari yang sama
        $exists = KosNotification::where('related_payment_id', $payment->id)
            ->whereDate('created_at', today())
            ->where('type', $newStatus === 'overdue' ? 'danger' : 'warning')
            ->exists();

        if ($exists) return;

        $tenant = $payment->tenant;
        $room   = $payment->room;

        if ($newStatus === 'due_soon') {
            $dueDate = Carbon::parse($payment->due_date);
            $daysLeft = Carbon::today()->diffInDays($dueDate, false);

            KosNotification::create([
                'title'              => 'Pembayaran Akan Jatuh Tempo',
                'message'            => "Pembayaran {$tenant->name} (Kamar {$room->room_number}) akan jatuh tempo dalam {$daysLeft} hari pada " . $dueDate->format('d M Y') . ".",
                'type'               => 'warning',
                'icon'               => 'heroicon-o-exclamation-triangle',
                'related_payment_id' => $payment->id,
                'related_tenant_id'  => $payment->tenant_id,
            ]);
        }

        if ($newStatus === 'overdue') {
            $overdueDays = Carbon::parse($payment->due_date)->diffInDays(Carbon::today());

            KosNotification::create([
                'title'              => 'Pembayaran Terlambat',
                'message'            => "Pembayaran {$tenant->name} (Kamar {$room->room_number}) sudah terlambat {$overdueDays} hari sejak " . Carbon::parse($payment->due_date)->format('d M Y') . ".",
                'type'               => 'danger',
                'icon'               => 'heroicon-o-x-circle',
                'related_payment_id' => $payment->id,
                'related_tenant_id'  => $payment->tenant_id,
            ]);
        }
    }
}
