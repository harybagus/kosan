<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use App\Models\Tenant;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTenants extends ListRecords
{
    protected static string $resource = TenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Penghuni')
                ->icon('heroicon-m-plus'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge(Tenant::count()),

            'active' => Tab::make('Aktif')
                ->badge(Tenant::where('status', 'active')->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'active')),

            'inactive' => Tab::make('Tidak Aktif')
                ->badge(Tenant::where('status', 'inactive')->count())
                ->badgeColor('gray')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'inactive')),
        ];
    }
}
