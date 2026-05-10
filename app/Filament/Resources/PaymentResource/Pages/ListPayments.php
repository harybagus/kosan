<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use App\Models\Payment;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Artisan;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('update_status')
                ->label('Update Status')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Update Status Pembayaran')
                ->modalDescription('Sistem akan mengecek dan memperbarui status semua pembayaran berdasarkan tanggal jatuh tempo. Lanjutkan?')
                ->modalSubmitActionLabel('Ya, Update Sekarang')
                ->action(function () {
                    Artisan::call('payments:update-status');

                    $dueSoon  = Payment::where('status', 'due_soon')->count();
                    $overdue  = Payment::where('status', 'overdue')->count();

                    Notification::make()
                        ->title('Status pembayaran berhasil diperbarui')
                        ->body("Jatuh tempo: {$dueSoon} | Terlambat: {$overdue}")
                        ->success()
                        ->send();
                }),

            Actions\CreateAction::make()
                ->label('Tambah Pembayaran')
                ->icon('heroicon-m-plus'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge(Payment::count()),

            'pending' => Tab::make('Pending')
                ->badge(Payment::where('status', 'pending')->count())
                ->badgeColor('gray')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'pending')),

            'due_soon' => Tab::make('Jatuh Tempo')
                ->badge(Payment::where('status', 'due_soon')->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'due_soon')),

            'overdue' => Tab::make('Terlambat')
                ->badge(Payment::where('status', 'overdue')->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'overdue')),

            'paid' => Tab::make('Lunas')
                ->badge(Payment::where('status', 'paid')->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'paid')),
        ];
    }
}
