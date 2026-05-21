<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use App\Models\Facility;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditRoom extends EditRecord
{
    protected static string $resource = RoomResource::class;

    protected string $oldImage = '';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label('Lihat'),
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->after(function ($record) {
                    if ($record->image) {
                        Storage::disk('public')->delete($record->image);
                    }
                })
                ->requiresConfirmation()
                ->modalHeading('Hapus Kamar')
                ->modalDescription('Yakin ingin menghapus kamar ini?')
                ->modalSubmitActionLabel('Ya, Hapus'),
        ];
    }

    protected function beforeSave(): void
    {
        $this->oldImage = $this->record->image ?? '';
    }

    protected function afterSave(): void
    {
        if ($this->oldImage && $this->oldImage !== $this->record->image) {
            Storage::disk('public')->delete($this->oldImage);
        }

        if ($this->record->type === 'standard') {
            $acFacility = Facility::where('name', 'AC')->first();
            if ($acFacility) {
                $this->record->facilities()->detach($acFacility->id);
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Kamar berhasil diperbarui';
    }
}
