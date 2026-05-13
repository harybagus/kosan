<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
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

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Infolists\Components\Section::make('Informasi Penghuni')
                ->icon('heroicon-o-user')
                ->schema([
                    Infolists\Components\Grid::make(3)->schema([

                        Infolists\Components\TextEntry::make('name')
                            ->label('Nama Lengkap')
                            ->weight('bold'),

                        Infolists\Components\TextEntry::make('phone')
                            ->label('Nomor HP')
                            ->placeholder('—'),

                        Infolists\Components\TextEntry::make('email')
                            ->label('Email')
                            ->placeholder('—'),

                        Infolists\Components\TextEntry::make('id_card_number')
                            ->label('Nomor KTP')
                            ->placeholder('—'),

                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->formatStateUsing(fn(string $state): string => match ($state) {
                                'active'   => 'Aktif',
                                'inactive' => 'Tidak Aktif',
                                default    => $state,
                            })
                            ->color(fn(string $state): string => match ($state) {
                                'active'   => 'success',
                                'inactive' => 'gray',
                                default    => 'gray',
                            }),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Didaftarkan')
                            ->dateTime('d M Y'),

                    ]),

                    Infolists\Components\TextEntry::make('notes')
                        ->label('Catatan')
                        ->placeholder('Tidak ada catatan.')
                        ->columnSpanFull(),
                ]),

            Infolists\Components\Section::make('Informasi Kamar & Kontrak')
                ->icon('heroicon-o-home')
                ->schema([
                    Infolists\Components\Grid::make(3)->schema([

                        Infolists\Components\TextEntry::make('room.room_number')
                            ->label('Kamar')
                            ->formatStateUsing(fn(string $state): string => 'Kamar ' . $state)
                            ->badge()
                            ->color('primary'),

                        Infolists\Components\TextEntry::make('room.type')
                            ->label('Tipe Kamar')
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

                        Infolists\Components\TextEntry::make('room.price')
                            ->label('Harga Sewa')
                            ->money('IDR'),

                        Infolists\Components\TextEntry::make('start_date')
                            ->label('Tanggal Masuk')
                            ->date('d M Y'),

                        Infolists\Components\TextEntry::make('end_date')
                            ->label('Rencana Keluar')
                            ->date('d M Y')
                            ->placeholder('—'),

                        Infolists\Components\TextEntry::make('duration')
                            ->label('Durasi Tinggal')
                            ->state(function ($record): string {
                                $start = \Carbon\Carbon::parse($record->start_date)->startOfDay();
                                $end = \Carbon\Carbon::parse($record->end_date ?? now())->startOfDay();

                                $months = (int) $start->diffInMonths($end);
                                $days = (int) $start->copy()->addMonths($months)->diffInDays($end);

                                $result = [];

                                if ($months > 0) {
                                    $result[] = $months . ' bulan';
                                }

                                if ($days > 0) {
                                    $result[] = $days . ' hari';
                                }

                                return empty($result) ? '0 hari' : implode(' ', $result);
                            }),

                    ]),
                ]),

            Infolists\Components\Section::make('Foto KTP')
                ->icon('heroicon-o-identification')
                ->collapsed()
                ->schema([
                    Infolists\Components\ImageEntry::make('id_card_image')
                        ->label('')
                        ->disk('public')
                        ->height(200)
                        ->columnSpanFull(),
                ])
                ->visible(fn($record) => $record->id_card_image !== null),

        ]);
    }
}
