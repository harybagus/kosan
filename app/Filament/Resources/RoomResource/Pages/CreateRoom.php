<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use App\Models\Facility;
use Filament\Resources\Pages\CreateRecord;

class CreateRoom extends CreateRecord
{
    protected static string $resource = RoomResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Kamar berhasil ditambahkan';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] ??= 'available';
        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->record->type === 'standard') {
            $acFacility = Facility::where('name', 'AC')->first();
            if ($acFacility) {
                $this->record->facilities()->detach($acFacility->id);
            }
        }
    }
}
