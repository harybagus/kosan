<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KosNotificationResource\Pages;
use App\Models\KosNotification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KosNotificationResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $model = KosNotification::class;

    protected static ?string $navigationIcon  = 'heroicon-o-bell';
    protected static ?string $navigationLabel = 'Notifikasi';
    protected static ?string $modelLabel      = 'Notifikasi';
    protected static ?string $pluralModelLabel = 'Notifikasi';
    protected static ?int    $navigationSort  = 5;

    // Badge merah di nav jika ada notifikasi belum dibaca
    public static function getNavigationBadge(): ?string
    {
        $count = KosNotification::whereNull('read_at')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    // =========================================================
    // FORM
    // =========================================================
    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Detail Notifikasi')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([

                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('type')
                            ->label('Tipe')
                            ->required()
                            ->options([
                                'info'    => 'Info',
                                'warning' => 'Peringatan',
                                'danger'  => 'Bahaya',
                            ])
                            ->default('info'),

                    ]),

                    Forms\Components\Textarea::make('message')
                        ->label('Pesan')
                        ->required()
                        ->rows(3)
                        ->columnSpanFull(),
                ]),

        ]);
    }

    // =========================================================
    // TABLE
    // =========================================================
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\IconColumn::make('read_status')
                    ->label('')
                    ->state(fn(KosNotification $record) => $record->read_at !== null)
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('gray')
                    ->falseColor('primary')
                    ->width('40px'),

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
                    ->searchable()
                    ->weight(fn(KosNotification $record) => $record->read_at ? 'normal' : 'bold'),

                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(60)
                    ->tooltip(fn(KosNotification $record) => $record->message)
                    ->searchable(),

                Tables\Columns\TextColumn::make('tenant.name')
                    ->label('Penghuni')
                    ->placeholder('—')
                    ->searchable(),

                Tables\Columns\TextColumn::make('read_at')
                    ->label('Dibaca')
                    ->dateTime('d M Y H:m')
                    ->placeholder('Belum dibaca')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diterima')
                    ->dateTime('d M Y H:m')
                    ->sortable(),

            ])
            ->defaultSort('created_at', 'desc')
            ->recordClasses(
                fn(KosNotification $record) => $record->read_at
                    ? 'opacity-60'
                    : ''
            )
            ->filters([

                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipe')
                    ->options([
                        'info'    => 'Info',
                        'warning' => 'Peringatan',
                        'danger'  => 'Bahaya',
                    ]),

                Tables\Filters\Filter::make('unread')
                    ->label('Belum Dibaca')
                    ->query(fn(Builder $query) => $query->whereNull('read_at'))
                    ->toggle(),

            ])
            ->actions([

                Tables\Actions\Action::make('mark_read')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-o-envelope-open')
                    ->color('gray')
                    ->visible(fn(KosNotification $record) => $record->read_at === null)
                    ->action(fn(KosNotification $record) => $record->markAsRead()),

                Tables\Actions\Action::make('view_payment')
                    ->label('Lihat Pembayaran')
                    ->icon('heroicon-o-banknotes')
                    ->color('primary')
                    ->visible(fn(KosNotification $record) => $record->related_payment_id !== null)
                    ->url(
                        fn(KosNotification $record): string =>
                        \App\Filament\Resources\PaymentResource::getUrl('view', [
                            'record' => $record->related_payment_id,
                        ])
                    ),

                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                    Tables\Actions\BulkAction::make('mark_all_read')
                        ->label('Tandai Semua Dibaca')
                        ->icon('heroicon-o-envelope-open')
                        ->action(function ($records) {
                            $records->each(fn($record) => $record->markAsRead());

                            \Filament\Notifications\Notification::make()
                                ->title('Semua notifikasi ditandai dibaca')
                                ->success()
                                ->send();
                        }),

                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus yang dipilih'),

                ]),
            ])
            ->emptyStateIcon('heroicon-o-bell')
            ->emptyStateHeading('Tidak ada notifikasi')
            ->emptyStateDescription('Sistem akan mengirim notifikasi otomatis saat ada pembayaran jatuh tempo.');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKosNotifications::route('/'),
            'create' => Pages\CreateKosNotification::route('/create'),
            'view'   => Pages\ViewKosNotification::route('/{record}'),
            'edit'   => Pages\EditKosNotification::route('/{record}/edit'),
        ];
    }
}
