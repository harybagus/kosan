<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
// use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Manajemen Kamar';

    protected static ?string $modelLabel = 'Kamar';

    protected static ?string $pluralModelLabel = 'Kamar';

    protected static ?int $navigationSort = 1;

    // =========================================================
    // FORM
    // =========================================================
    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Informasi Kamar')
                ->description('Data utama kamar kos')
                ->icon('heroicon-o-building-office-2')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([

                        Forms\Components\TextInput::make('room_number')
                            ->label('Nomor Kamar')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: 101')
                            ->maxLength(3),

                        Forms\Components\Select::make('type')
                            ->label('Tipe Kamar')
                            ->required()
                            ->options([
                                'standard' => 'Standard',
                                'premium'  => 'Premium',
                            ])
                            ->live()
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state === 'standard') {
                                    $set('facilities', []);
                                }
                            }),

                        Forms\Components\TextInput::make('price')
                            ->label('Harga per Bulan')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0)
                            ->placeholder('800000'),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'available' => 'Tersedia',
                                'occupied'  => 'Terisi',
                            ])
                            ->default('available'),

                    ]),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->placeholder('Deskripsi tambahan tentang kamar ini...')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Fasilitas')
                ->description('Pilih fasilitas yang tersedia di kamar ini')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    Forms\Components\CheckboxList::make('facilities')
                        ->label('')
                        ->relationship('facilities', 'name')
                        ->columns(3)
                        ->gridDirection('row'),
                ]),

            Forms\Components\Section::make('Foto Kamar')
                ->description('Upload foto kamar (opsional)')
                ->icon('heroicon-o-photo')
                ->collapsed()
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label('')
                        ->image()
                        ->directory('rooms')
                        ->visibility('public')
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

                Tables\Columns\TextColumn::make('room_number')
                    ->label('No. Kamar')
                    ->searchable()
                    ->sortable()
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
                        default   => 'heroicon-o-building-office-2',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga/Bulan')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'available' => 'Tersedia',
                        'occupied'  => 'Terisi',
                        default     => $state,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'available' => 'success',
                        'occupied'  => 'danger',
                        default     => 'gray',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'available' => 'heroicon-o-check-circle',
                        'occupied'  => 'heroicon-o-x-circle',
                        default     => 'heroicon-o-question-mark-circle',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('facilities.name')
                    ->label('Fasilitas')
                    ->badge()
                    ->color('primary')
                    ->separator(','),

                Tables\Columns\TextColumn::make('activeTenant.name')
                    ->label('Penghuni Aktif')
                    ->placeholder('— kosong —')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipe')
                    ->options([
                        'standard' => 'Standard',
                        'premium'  => 'Premium',
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'available' => 'Tersedia',
                        'occupied'  => 'Terisi',
                    ]),

            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat'),
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->after(function ($record) {
                        if ($record->image) {
                            Storage::disk('public')->delete($record->image);
                        }
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Kamar')
                    ->modalDescription('Yakin ingin menghapus kamar ini? Data yang sudah dihapus tidak dapat dikembalikan.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus yang dipilih')
                        ->after(function (Collection $records) {
                            foreach ($records as $record) {
                                if ($record->image) {
                                    Storage::disk('public')->delete($record->image);
                                }
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Kamar Terpilih')
                        ->modalDescription('Yakin ingin menghapus semua kamar yang dipilih?')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->defaultSort('room_number', 'asc')
            ->emptyStateIcon('heroicon-o-building-office-2')
            ->emptyStateHeading('Belum ada kamar')
            ->emptyStateDescription('Mulai dengan menambahkan kamar pertama.')
            ->emptyStateActions([
                Tables\Actions\Action::make('create')
                    ->label('Tambah Kamar')
                    ->url(fn() => static::getUrl('create'))
                    ->icon('heroicon-m-plus')
                    ->button(),
            ]);
    }

    // =========================================================
    // RELATIONS, PAGES, SEARCH
    // =========================================================
    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'view'   => Pages\ViewRoom::route('/{record}'),
            'edit'   => Pages\EditRoom::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['room_number', 'description'];
    }
}
