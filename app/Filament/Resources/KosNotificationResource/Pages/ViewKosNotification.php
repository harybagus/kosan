<?php

namespace App\Filament\Resources\KosNotificationResource\Pages;

use App\Filament\Resources\KosNotificationResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewKosNotification extends ViewRecord
{
    protected static string $resource = KosNotificationResource::class;

    // Auto mark as read saat halaman dibuka
    public function mount(int|string $record): void
    {
        parent::mount($record);

        if ($this->record->read_at === null) {
            $this->record->markAsRead();
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view_payment')
                ->label('Lihat Pembayaran Terkait')
                ->icon('heroicon-o-banknotes')
                ->color('primary')
                ->visible(fn() => $this->record->related_payment_id !== null)
                ->url(
                    fn(): string =>
                    \App\Filament\Resources\PaymentResource::getUrl('view', [
                        'record' => $this->record->related_payment_id,
                    ])
                ),

            Actions\DeleteAction::make()
                ->label('Hapus'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Infolists\Components\Section::make('Detail Notifikasi')
                ->icon('heroicon-o-bell')
                ->schema([
                    Infolists\Components\Grid::make(3)->schema([

                        Infolists\Components\TextEntry::make('type')
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
                            }),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Diterima')
                            ->dateTime('d M Y H:m'),

                        Infolists\Components\TextEntry::make('read_at')
                            ->label('Dibaca')
                            ->dateTime('d M Y H:m')
                            ->placeholder('Belum dibaca'),

                    ]),

                    Infolists\Components\TextEntry::make('title')
                        ->label('Judul')
                        ->weight('bold')
                        ->columnSpanFull(),

                    Infolists\Components\TextEntry::make('message')
                        ->label('Pesan')
                        ->columnSpanFull(),
                ]),

            Infolists\Components\Section::make('Data Terkait')
                ->icon('heroicon-o-link')
                ->schema([
                    Infolists\Components\Grid::make(2)->schema([

                        Infolists\Components\TextEntry::make('tenant.name')
                            ->label('Penghuni Terkait')
                            ->placeholder('—'),

                        Infolists\Components\TextEntry::make('payment.due_date')
                            ->label('Tanggal Jatuh Tempo')
                            ->date('d M Y')
                            ->placeholder('—'),

                    ]),
                ])
                ->visible(
                    fn($record) =>
                    $record->related_tenant_id !== null ||
                        $record->related_payment_id !== null
                ),

        ]);
    }
}
