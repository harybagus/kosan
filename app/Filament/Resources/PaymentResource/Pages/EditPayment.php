<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditPayment extends EditRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label('Lihat'),
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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Pembayaran berhasil diperbarui';
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Auto-isi paid_date jika status diubah ke paid
        if ($data['status'] === 'paid' && empty($data['paid_date'])) {
            $data['paid_date'] = now()->toDateString();
        }

        // Kosongkan paid_date jika status bukan paid
        if ($data['status'] !== 'paid') {
            $data['paid_date'] = null;
        }

        return $data;
    }
}
