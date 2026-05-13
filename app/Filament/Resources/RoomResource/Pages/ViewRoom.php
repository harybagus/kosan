<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
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

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Infolists\Components\Section::make('Informasi Kamar')
                ->icon('heroicon-o-home')
                ->schema([
                    Infolists\Components\Grid::make(3)->schema([

                        Infolists\Components\TextEntry::make('room_number')
                            ->label('Nomor Kamar')
                            ->weight('bold')
                            ->formatStateUsing(fn(string $state): string => 'Kamar ' . $state),

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
                            ->label('Harga per Bulan')
                            ->money('IDR'),

                        Infolists\Components\TextEntry::make('facilities.name')
                            ->label('Fasilitas')
                            ->badge()
                            ->color('primary')
                            ->separator(','),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Ditambahkan')
                            ->dateTime('d M Y'),

                    ]),

                    Infolists\Components\TextEntry::make('description')
                        ->label('Deskripsi')
                        ->placeholder('Tidak ada deskripsi.')
                        ->columnSpanFull(),
                ]),

            Infolists\Components\Section::make('Foto Kamar')
                ->icon('heroicon-o-photo')
                ->collapsed()
                ->schema([
                    Infolists\Components\ImageEntry::make('image')
                        ->label('')
                        ->disk('public')
                        ->height(300)
                        ->columnSpanFull(),
                ])
                ->visible(fn($record) => $record->image !== null),

            Infolists\Components\Section::make('Penghuni Saat Ini')
                ->icon('heroicon-o-user')
                ->schema([
                    Infolists\Components\Grid::make(3)->schema([

                        Infolists\Components\TextEntry::make('activeTenant.name')
                            ->label('Nama Penghuni')
                            ->placeholder('— Kamar kosong —')
                            ->weight('bold'),

                        Infolists\Components\TextEntry::make('activeTenant.phone')
                            ->label('No. HP')
                            ->placeholder('—'),

                        Infolists\Components\TextEntry::make('activeTenant.start_date')
                            ->label('Tanggal Masuk')
                            ->date('d M Y')
                            ->placeholder('—'),

                    ]),
                ]),

        ]);
    }
}
