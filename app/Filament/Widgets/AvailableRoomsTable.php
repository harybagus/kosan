<?php

namespace App\Filament\Widgets;

use App\Models\Room;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class AvailableRoomsTable extends BaseWidget
{
    protected static ?string $heading = 'Kamar Tersedia';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Room::query()
                    ->where('status', 'available')
                    ->with('facilities')
                    ->orderBy('room_number')
            )
            ->columns([
                Tables\Columns\TextColumn::make('room_number')
                    ->label('No. Kamar')
                    ->weight('bold')
                    ->formatStateUsing(fn(string $state): string => 'Kamar ' . $state),

                Tables\Columns\TextColumn::make('type')
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
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'premium' => 'heroicon-s-sparkles',
                        default   => 'heroicon-o-home',
                    }),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga/Bulan')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('facilities.name')
                    ->label('Fasilitas')
                    ->badge()
                    ->color('primary')
                    ->separator(','),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->url(
                        fn(Room $record): string =>
                        \App\Filament\Resources\RoomResource::getUrl('view', ['record' => $record])
                    ),

                Tables\Actions\Action::make('add_tenant')
                    ->label('Tambah Penghuni')
                    ->icon('heroicon-o-user-plus')
                    ->color('primary')
                    ->url(
                        fn(Room $record): string =>
                        \App\Filament\Resources\TenantResource::getUrl('create') . '?room_id=' . $record->id
                    ),
            ])
            ->emptyStateHeading('Tidak ada kamar tersedia')
            ->emptyStateDescription('Semua kamar sedang terisi.')
            ->emptyStateIcon('heroicon-o-home');
    }
}
