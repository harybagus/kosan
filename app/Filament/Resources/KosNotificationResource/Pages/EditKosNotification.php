<?php

namespace App\Filament\Resources\KosNotificationResource\Pages;

use App\Filament\Resources\KosNotificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKosNotification extends EditRecord
{
    protected static string $resource = KosNotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Notifikasi berhasil diperbarui';
    }
}
