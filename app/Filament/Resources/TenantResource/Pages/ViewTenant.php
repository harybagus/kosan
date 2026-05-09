<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewTenant extends ViewRecord
{
    protected static string $resource = TenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit'),
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->after(function ($record) {
                    if ($record->id_card_image) {
                        Storage::disk('public')->delete($record->id_card_image);
                    }
                })
                ->requiresConfirmation()
                ->modalHeading('Hapus Penghuni')
                ->modalDescription('Yakin ingin menghapus data penghuni ini?')
                ->modalSubmitActionLabel('Ya, Hapus'),
        ];
    }
}
