<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use App\Models\Room;
use App\Models\Tenant;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Penghuni berhasil didaftarkan';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Double-check: pastikan kamar belum terisi
        if (isset($data['room_id']) && $data['status'] === 'active') {
            $occupied = Tenant::where('room_id', $data['room_id'])
                ->where('status', 'active')
                ->exists();

            if ($occupied) {
                $room = Room::find($data['room_id']);
                Notification::make()
                    ->title('Kamar sudah terisi')
                    ->body("Kamar {$room->room_number} sudah ditempati penghuni aktif lain.")
                    ->danger()
                    ->send();

                $this->halt();
            }
        }

        return $data;
    }

    // Otomatis update status kamar jadi 'occupied' saat tenant aktif dibuat
    protected function afterCreate(): void
    {
        $tenant = $this->record;

        if ($tenant->status === 'active' && $tenant->room_id) {
            Room::where('id', $tenant->room_id)
                ->update(['status' => 'occupied']);
        }
    }
}
