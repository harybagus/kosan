<?php

namespace App\Filament\Resources\FacilityResource\Pages;

use App\Filament\Resources\FacilityResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewFacility extends ViewRecord
{
    protected static string $resource = FacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit'),
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->requiresConfirmation()
                ->modalHeading('Hapus Fasilitas')
                ->modalDescription('Yakin ingin menghapus fasilitas ini?')
                ->modalSubmitActionLabel('Ya, Hapus'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Infolists\Components\Section::make('Informasi Fasilitas')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    Infolists\Components\Grid::make(3)->schema([

                        Infolists\Components\TextEntry::make('name')
                            ->label('Nama Fasilitas')
                            ->weight('bold'),

                        Infolists\Components\TextEntry::make('icon')
                            ->label('Icon')
                            ->placeholder('—'),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d M Y'),

                    ]),
                ]),

            Infolists\Components\Section::make('Kamar yang Menggunakan Fasilitas Ini')
                ->icon('heroicon-o-home')
                ->schema([
                    Infolists\Components\RepeatableEntry::make('rooms')
                        ->label('')
                        ->schema([
                            Infolists\Components\Grid::make(4)->schema([

                                Infolists\Components\TextEntry::make('room_number')
                                    ->label('Nomor')
                                    ->formatStateUsing(fn(string $state): string => 'Kamar ' . $state)
                                    ->weight('bold'),

                                Infolists\Components\TextEntry::make('type')
                                    ->label('Tipe')
                                    ->badge()
                                    ->formatStateUsing(fn(string $state): string => match ($state) {
                                        'standard' => 'Standard',
                                        'premium'  => 'Premium',
                                        default    => $state,
                                    })
                                    ->color(fn(string $state): string => match ($state) {
                                        'premium' => 'warning',
                                        default   => 'gray',
                                    }),

                                Infolists\Components\TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->formatStateUsing(fn(string $state): string => match ($state) {
                                        'available' => 'Tersedia',
                                        'occupied'  => 'Terisi',
                                        default     => $state,
                                    })
                                    ->color(fn(string $state): string => match ($state) {
                                        'available' => 'success',
                                        'occupied'  => 'danger',
                                        default     => 'gray',
                                    }),

                                Infolists\Components\TextEntry::make('price')
                                    ->label('Harga')
                                    ->money('IDR'),

                            ]),
                        ])
                        ->columnSpanFull(),
                ]),

        ]);
    }
}
