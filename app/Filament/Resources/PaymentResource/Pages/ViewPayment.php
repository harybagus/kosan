<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewPayment extends ViewRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit'),

            Actions\Action::make('mark_paid')
                ->label('Tandai Lunas')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Tandai Pembayaran Lunas')
                ->modalSubmitActionLabel('Ya, Tandai Lunas')
                ->visible(fn() => $this->record->status !== 'paid')
                ->action(function () {
                    $this->record->update([
                        'status'    => 'paid',
                        'paid_date' => now(),
                    ]);

                    \Filament\Notifications\Notification::make()
                        ->title('Pembayaran ditandai lunas')
                        ->success()
                        ->send();

                    $this->refreshFormData(['status', 'paid_date']);
                }),

            Actions\DeleteAction::make()
                ->label('Hapus')
                ->after(function ($record) {
                    if ($record->proof_image) {
                        Storage::disk('public')->delete($record->proof_image);
                    }
                })
                ->requiresConfirmation()
                ->modalHeading('Hapus Pembayaran')
                ->modalDescription('Yakin ingin menghapus data pembayaran ini?')
                ->modalSubmitActionLabel('Ya, Hapus'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Infolists\Components\Section::make('Informasi Pembayaran')
                ->icon('heroicon-o-banknotes')
                ->schema([
                    Infolists\Components\Grid::make(3)->schema([

                        Infolists\Components\TextEntry::make('tenant.name')
                            ->label('Penghuni')
                            ->weight('bold'),

                        Infolists\Components\TextEntry::make('room.room_number')
                            ->label('Kamar')
                            ->formatStateUsing(fn(string $state): string => 'Kamar ' . $state)
                            ->badge()
                            ->color('primary'),

                        Infolists\Components\TextEntry::make('amount')
                            ->label('Jumlah Tagihan')
                            ->money('IDR')
                            ->weight('bold'),

                        Infolists\Components\TextEntry::make('due_date')
                            ->label('Tanggal Jatuh Tempo')
                            ->date('d M Y'),

                        Infolists\Components\TextEntry::make('paid_date')
                            ->label('Tanggal Dibayar')
                            ->date('d M Y')
                            ->placeholder('Belum dibayar'),

                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->formatStateUsing(fn(string $state): string => match ($state) {
                                'pending'  => 'Pending',
                                'due_soon' => 'Jatuh Tempo',
                                'overdue'  => 'Terlambat',
                                'paid'     => 'Lunas',
                                default    => $state,
                            })
                            ->color(fn(string $state): string => match ($state) {
                                'pending'  => 'gray',
                                'due_soon' => 'warning',
                                'overdue'  => 'danger',
                                'paid'     => 'success',
                                default    => 'gray',
                            }),

                        Infolists\Components\TextEntry::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->default('—')
                            ->formatStateUsing(fn(?string $state): string => match ($state) {
                                'cash'     => 'Tunai',
                                'transfer' => 'Transfer Bank',
                                'qris'     => 'QRIS',
                                default    => $state,
                            }),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d M Y H:m'),

                    ]),

                    Infolists\Components\TextEntry::make('notes')
                        ->label('Catatan')
                        ->placeholder('Tidak ada catatan.')
                        ->columnSpanFull(),
                ]),

            Infolists\Components\Section::make('Bukti Pembayaran')
                ->icon('heroicon-o-photo')
                ->collapsed()
                ->schema([
                    Infolists\Components\ImageEntry::make('proof_image')
                        ->label('')
                        ->disk('public')
                        ->height(300)
                        ->columnSpanFull(),
                ])
                ->visible(fn($record) => $record->proof_image !== null),

        ]);
    }
}
