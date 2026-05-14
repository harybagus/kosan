<?php

namespace App\Filament\Resources\KosNotificationResource\Pages;

use App\Filament\Resources\KosNotificationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKosNotification extends CreateRecord
{
    protected static string $resource = KosNotificationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Notifikasi berhasil dibuat';
    }
}
