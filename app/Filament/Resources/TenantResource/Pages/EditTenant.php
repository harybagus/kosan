<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use App\Models\Room;
use App\Models\Tenant;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditTenant extends EditRecord
{
    protected static string $resource = TenantResource::class;

    protected ?int $oldRoomId = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label('Lihat'),

            Actions\DeleteAction::make()
                ->label('Hapus')
                ->requiresConfirmation()
                ->modalHeading('Hapus Penghuni')
                ->modalDescription('Yakin ingin menghapus data penghuni ini? Kamar yang ditempati akan otomatis menjadi tersedia kembali.')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->after(function ($record) {
                    if ($record->room_id) {
                        Room::where('id', $record->room_id)
                            ->update(['status' => 'available']);
                    }
                }),
        ];
    }

    // Validasi sebelum form disimpan
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $newRoomId     = (int) ($data['room_id'] ?? 0);
        $currentRoomId = $this->record->room_id;
        $roomChanged   = $newRoomId !== $currentRoomId;

        // Jika pindah kamar dengan status aktif, cek kamar baru tidak terisi
        if ($roomChanged && ($data['status'] ?? 'active') === 'active') {
            $isOccupied = Tenant::where('room_id', $newRoomId)
                ->where('status', 'active')
                ->where('id', '!=', $this->record->id)
                ->exists();

            if ($isOccupied) {
                $room = Room::find($newRoomId);
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

    // Tangkap room_id lama tepat sebelum query UPDATE dijalankan
    protected function beforeSave(): void
    {
        $this->oldRoomId = $this->record->room_id;
    }

    // Update status kamar setelah data tersimpan
    protected function afterSave(): void
    {
        $tenant    = $this->record;
        $newRoomId = $tenant->room_id;

        // Bebaskan kamar lama jika kamar berubah
        if ($this->oldRoomId && $this->oldRoomId !== $newRoomId) {
            Room::where('id', $this->oldRoomId)
                ->update(['status' => 'available']);
        }

        // Update status kamar saat ini
        if ($newRoomId) {
            $newStatus = $tenant->status === 'active' ? 'occupied' : 'available';
            Room::where('id', $newRoomId)
                ->update(['status' => $newStatus]);
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Data penghuni berhasil diperbarui';
    }
}
