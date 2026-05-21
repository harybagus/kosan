<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacilityResource\Pages;
use App\Models\Facility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static ?string $navigationIcon  = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'Fasilitas';
    protected static ?string $modelLabel      = 'Fasilitas';
    protected static ?string $pluralModelLabel = 'Fasilitas';
    protected static ?string $navigationGroup = 'Manajemen';
    protected static ?int    $navigationSort  = 4;

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view_facility') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create_facility') ?? false;
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->user()?->can('edit_facility') ?? false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->user()?->can('delete_facility') ?? false;
    }

    // =========================================================
    // FORM
    // =========================================================
    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Informasi Fasilitas')
                ->description('Data fasilitas kamar kos')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Fasilitas')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: AC, WiFi, Lemari')
                            ->maxLength(50),

                        Forms\Components\TextInput::make('icon')
                            ->label('Icon (Heroicon)')
                            ->placeholder('heroicon-o-sun')
                            ->helperText('Nama heroicon, contoh: heroicon-o-wifi')
                            ->maxLength(100),

                    ]),
                ]),

            Forms\Components\Section::make('Kamar yang Menggunakan Fasilitas Ini')
                ->description('Daftar kamar yang memiliki fasilitas ini')
                ->icon('heroicon-o-home')
                ->collapsed()
                ->schema([
                    Forms\Components\Placeholder::make('rooms_list')
                        ->label('')
                        ->content(function (?Facility $record): string {
                            if (!$record) return 'Simpan fasilitas terlebih dahulu untuk melihat kamar.';

                            $rooms = $record->rooms;
                            if ($rooms->isEmpty()) return 'Belum ada kamar yang menggunakan fasilitas ini.';

                            return $rooms->map(fn($r) => "Kamar {$r->room_number} ({$r->type})")->join(', ');
                        }),
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

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Fasilitas')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('rooms_count')
                    ->label('Digunakan di')
                    ->counts('rooms')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn(int $state): string => $state . ' kamar'),

                Tables\Columns\TextColumn::make('rooms.room_number')
                    ->label('Kamar')
                    ->badge()
                    ->color('gray')
                    ->separator(',')
                    ->formatStateUsing(fn(string $state): string => 'Kamar ' . $state)
                    ->limitList(5),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat'),
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Fasilitas')
                    ->modalDescription('Yakin ingin menghapus fasilitas ini? Fasilitas akan dihapus dari semua kamar.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus yang dipilih')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Fasilitas Terpilih')
                        ->modalDescription('Fasilitas akan dihapus dari semua kamar terkait.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->defaultSort('name', 'asc')
            ->emptyStateIcon('heroicon-o-sparkles')
            ->emptyStateHeading('Belum ada fasilitas')
            ->emptyStateDescription('Tambahkan fasilitas seperti AC, WiFi, Lemari, dll.')
            ->emptyStateActions([
                Tables\Actions\Action::make('create')
                    ->label('Tambah Fasilitas')
                    ->url(fn() => static::getUrl('create'))
                    ->icon('heroicon-m-plus')
                    ->button(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListFacilities::route('/'),
            'create' => Pages\CreateFacility::route('/create'),
            'view'   => Pages\ViewFacility::route('/{record}'),
            'edit'   => Pages\EditFacility::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
