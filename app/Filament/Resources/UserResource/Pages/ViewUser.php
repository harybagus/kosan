<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Edit'),
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->requiresConfirmation(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Infolists\Components\Section::make('Informasi User')
                ->icon('heroicon-o-user')
                ->schema([
                    Infolists\Components\Grid::make(3)->schema([

                        Infolists\Components\TextEntry::make('name')
                            ->label('Nama Lengkap')
                            ->weight('bold'),

                        Infolists\Components\TextEntry::make('email')
                            ->label('Email'),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d M Y'),

                    ]),
                ]),

            Infolists\Components\Section::make('Hak Akses')
                ->icon('heroicon-o-shield-check')
                ->schema([
                    Infolists\Components\TextEntry::make('roles.name')
                        ->label('Role')
                        ->badge()
                        ->formatStateUsing(fn(string $state): string => match ($state) {
                            'super_admin' => 'Super Admin',
                            'admin'       => 'Admin',
                            'staff'       => 'Staff',
                            default       => $state,
                        })
                        ->color(fn(string $state): string => match ($state) {
                            'super_admin' => 'danger',
                            'admin'       => 'warning',
                            'staff'       => 'gray',
                            default       => 'gray',
                        }),
                ]),

        ]);
    }
}
