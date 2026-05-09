<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewPayment extends ViewRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit'),

            Actions\Action::make('mark_paid')
                ->label('Tandai Lunas')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Tandai Pembayaran Lunas')
                ->modalSubmitActionLabel('Ya, Tandai Lunas')
                ->visible(fn() => $this->record->status !== 'paid')
                ->action(function () {
                    $this->record->update([
                        'status'    => 'paid',
                        'paid_date' => now(),
                    ]);

                    \Filament\Notifications\Notification::make()
                        ->title('Pembayaran ditandai lunas')
                        ->success()
                        ->send();

                    $this->refreshFormData(['status', 'paid_date']);
                }),

            Actions\DeleteAction::make()
                ->label('Hapus')
                ->after(function ($record) {
                    if ($record->proof_image) {
                        Storage::disk('public')->delete($record->proof_image);
                    }
                })
                ->requiresConfirmation()
                ->modalHeading('Hapus Pembayaran')
                ->modalDescription('Yakin ingin menghapus data pembayaran ini?')
                ->modalSubmitActionLabel('Ya, Hapus'),
        ];
    }
}
