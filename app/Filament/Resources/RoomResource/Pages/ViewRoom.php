<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewRoom extends ViewRecord
{
    protected static string $resource = RoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit'),
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
}
