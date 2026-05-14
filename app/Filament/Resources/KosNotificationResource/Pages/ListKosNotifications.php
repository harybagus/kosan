<?php

namespace App\Filament\Resources\KosNotificationResource\Pages;

use App\Filament\Resources\KosNotificationResource;
use App\Models\KosNotification;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListKosNotifications extends ListRecords
{
    protected static string $resource = KosNotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tandai semua dibaca
            Actions\Action::make('mark_all_read')
                ->label('Tandai Semua Dibaca')
                ->icon('heroicon-o-envelope-open')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Tandai Semua Dibaca')
                ->modalDescription('Tandai semua notifikasi sebagai sudah dibaca?')
                ->modalSubmitActionLabel('Ya, Tandai Semua')
                ->visible(fn() => KosNotification::whereNull('read_at')->exists())
                ->action(function () {
                    KosNotification::whereNull('read_at')
                        ->update(['read_at' => now()]);

                    \Filament\Notifications\Notification::make()
                        ->title('Semua notifikasi ditandai dibaca')
                        ->success()
                        ->send();
                }),

            // Hapus semua yang sudah dibaca
            Actions\Action::make('clear_read')
                ->label('Hapus yang Sudah Dibaca')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Hapus Notifikasi yang Sudah Dibaca')
                ->modalDescription('Hapus semua notifikasi yang sudah dibaca?')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->visible(fn() => KosNotification::whereNotNull('read_at')->exists())
                ->action(function () {
                    KosNotification::whereNotNull('read_at')->delete();

                    \Filament\Notifications\Notification::make()
                        ->title('Notifikasi yang sudah dibaca berhasil dihapus')
                        ->success()
                        ->send();
                }),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge(KosNotification::count()),

            'unread' => Tab::make('Belum Dibaca')
                ->badge(KosNotification::whereNull('read_at')->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNull('read_at')),

            'warning' => Tab::make('Peringatan')
                ->badge(KosNotification::where('type', 'warning')->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'warning')),

            'danger' => Tab::make('Bahaya')
                ->badge(KosNotification::where('type', 'danger')->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'danger')),

            'read' => Tab::make('Sudah Dibaca')
                ->badge(KosNotification::whereNotNull('read_at')->count())
                ->badgeColor('gray')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNotNull('read_at')),
        ];
    }
}
