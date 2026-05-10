<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPaymentsTable extends BaseWidget
{
    protected static ?string $heading = 'Pembayaran yang Perlu Perhatian';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Payment::query()
                    ->whereIn('status', ['due_soon', 'overdue'])
                    ->with(['tenant', 'room'])
                    ->orderByRaw("FIELD(status, 'overdue', 'due_soon')")
                    ->orderBy('due_date', 'asc')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('tenant.name')
                    ->label('Penghuni')
                    ->weight('bold')
                    ->searchable(),

                Tables\Columns\TextColumn::make('room.room_number')
                    ->label('Kamar')
                    ->formatStateUsing(fn(string $state): string => 'Kamar ' . $state)
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('due_date')
                    ->label('Jatuh Tempo')
                    ->date('d M Y'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'due_soon' => 'Jatuh Tempo',
                        'overdue'  => 'Terlambat',
                        default    => $state,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'due_soon' => 'warning',
                        'overdue'  => 'danger',
                        default    => 'gray',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'due_soon' => 'heroicon-o-exclamation-triangle',
                        'overdue'  => 'heroicon-o-x-circle',
                        default    => 'heroicon-o-clock',
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_paid')
                    ->label('Tandai Lunas')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Pembayaran Lunas')
                    ->modalSubmitActionLabel('Ya, Tandai Lunas')
                    ->action(function (Payment $record) {
                        $record->update([
                            'status'    => 'paid',
                            'paid_date' => now(),
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Pembayaran ditandai lunas')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->url(
                        fn(Payment $record): string =>
                        \App\Filament\Resources\PaymentResource::getUrl('view', ['record' => $record])
                    ),
            ])
            ->emptyStateHeading('Tidak ada pembayaran bermasalah')
            ->emptyStateDescription('Semua pembayaran dalam kondisi baik.')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
