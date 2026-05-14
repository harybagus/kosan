<?php

namespace App\Filament\Widgets;

use App\Models\KosNotification;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class NotificationWidget extends BaseWidget
{
    protected static ?string $heading       = 'Notifikasi Terbaru';
    protected static ?int    $sort          = 5;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                KosNotification::query()
                    ->whereNull('read_at')
                    ->with(['tenant', 'payment'])
                    ->orderByRaw("FIELD(type, 'danger', 'warning', 'info')")
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
            )
            ->columns([

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'info'    => 'Info',
                        'warning' => 'Peringatan',
                        'danger'  => 'Bahaya',
                        default   => $state,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'info'    => 'info',
                        'warning' => 'warning',
                        'danger'  => 'danger',
                        default   => 'gray',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'info'    => 'heroicon-o-information-circle',
                        'warning' => 'heroicon-o-exclamation-triangle',
                        'danger'  => 'heroicon-o-x-circle',
                        default   => 'heroicon-o-bell',
                    }),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->weight('bold')
                    ->searchable(),

                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(80)
                    ->tooltip(fn(KosNotification $record) => $record->message),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->since()
                    ->sortable(),

            ])
            ->actions([

                Tables\Actions\Action::make('mark_read')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-o-check')
                    ->color('gray')
                    ->action(function (KosNotification $record) {
                        $record->markAsRead();

                        \Filament\Notifications\Notification::make()
                            ->title('Notifikasi ditandai dibaca')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('view_payment')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->visible(fn(KosNotification $record) => $record->related_payment_id !== null)
                    ->url(
                        fn(KosNotification $record): string =>
                        \App\Filament\Resources\PaymentResource::getUrl('view', [
                            'record' => $record->related_payment_id,
                        ])
                    ),

            ])
            ->emptyStateHeading('Tidak ada notifikasi baru')
            ->emptyStateDescription('Semua notifikasi sudah dibaca.')
            ->emptyStateIcon('heroicon-o-bell-slash');
    }
}
