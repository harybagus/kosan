<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Models\Room;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Manajemen Penghuni';

    protected static ?string $modelLabel = 'Penghuni';

    protected static ?string $pluralModelLabel = 'Penghuni';

    protected static ?int $navigationSort = 2;

    // =========================================================
    // FORM
    // =========================================================
    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Informasi Penghuni')
                ->description('Data diri penghuni kos')
                ->icon('heroicon-o-user')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Masukkan nama lengkap'),

                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor HP')
                            ->required()
                            ->tel()
                            ->maxLength(15)
                            ->placeholder('08xxxxxxxxxx'),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(100)
                            ->placeholder('name@email.com'),

                        Forms\Components\TextInput::make('id_card_number')
                            ->label('Nomor KTP')
                            ->maxLength(16)
                            ->placeholder('16 digit nomor KTP'),

                    ]),

                    Forms\Components\FileUpload::make('id_card_image')
                        ->label('Foto KTP')
                        ->image()
                        ->disk('public')
                        ->directory('tenants/ktp')
                        ->visibility('public')
                        ->imagePreviewHeight('150')
                        ->panelLayout('integrated')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Informasi Kamar & Kontrak')
                ->description('Data kamar dan periode sewa')
                ->icon('heroicon-o-building-office-2')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([

                        Forms\Components\Select::make('room_id')
                            ->label('Kamar')
                            ->required()
                            ->options(function () {
                                return Room::with('facilities')
                                    ->get()
                                    ->mapWithKeys(function (Room $room) {
                                        $type   = $room->type === 'premium' ? '⭐ Premium' : 'Standard';
                                        $status = $room->status === 'available' ? '✅ Tersedia' : '❌ Terisi';
                                        $price  = 'Rp ' . number_format($room->price, 0, ',', '.');
                                        return [
                                            $room->id => "Kamar {$room->room_number} — {$type} — {$price} — {$status}",
                                        ];
                                    });
                            })
                            ->searchable()
                            ->live(),

                        Forms\Components\Select::make('status')
                            ->label('Status Penghuni')
                            ->required()
                            ->options([
                                'active'   => 'Aktif',
                                'inactive' => 'Tidak Aktif',
                            ])
                            ->default('active')
                            ->live(),

                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Masuk')
                            ->required()
                            ->default(now())
                            ->displayFormat('d/m/Y')
                            ->maxDate(now()->addDays(30)),

                        Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Keluar (Rencana)')
                            ->displayFormat('d/m/Y')
                            ->minDate(fn(Get $get) => $get('start_date') ?? now())
                            ->nullable(),

                    ]),

                    Forms\Components\Textarea::make('notes')
                        ->label('Catatan')
                        ->placeholder('Catatan tambahan tentang penghuni...')
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

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Penghuni')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('room.room_number')
                    ->label('Kamar')
                    ->formatStateUsing(fn(string $state): string => 'Kamar ' . $state)
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                Tables\Columns\TextColumn::make('room.type')
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
                    }),

                Tables\Columns\TextColumn::make('phone')
                    ->label('No. HP')
                    ->searchable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Tanggal Masuk')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Tanggal Keluar')
                    ->date('d M Y')
                    ->placeholder('—')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'active'   => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                        default    => $state,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'active'   => 'success',
                        'inactive' => 'gray',
                        default    => 'gray',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'active'   => 'heroicon-o-check-circle',
                        'inactive' => 'heroicon-o-x-circle',
                        default    => 'heroicon-o-question-mark-circle',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Didaftarkan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active'   => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                    ]),

                Tables\Filters\SelectFilter::make('room_id')
                    ->label('Kamar')
                    ->relationship('room', 'room_number')
                    ->searchable(),

            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat'),
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->after(function ($record) {
                        if ($record->id_card_image) {
                            Storage::disk('public')->delete($record->id_card_image);
                        }
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Penghuni')
                    ->modalDescription('Yakin ingin menghapus data penghuni ini?')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus yang dipilih')
                        ->after(function (Collection $records) {
                            foreach ($records as $record) {
                                if ($record->id_card_image) {
                                    Storage::disk('public')->delete($record->id_card_image);
                                }
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Penghuni Terpilih')
                        ->modalDescription('Yakin ingin menghapus semua penghuni yang dipilih?')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateIcon('heroicon-o-users')
            ->emptyStateHeading('Belum ada penghuni')
            ->emptyStateDescription('Mulai dengan mendaftarkan penghuni pertama.')
            ->emptyStateActions([
                Tables\Actions\Action::make('create')
                    ->label('Tambah Penghuni')
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
            'index'  => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'view'   => Pages\ViewTenant::route('/{record}'),
            'edit'   => Pages\EditTenant::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email', 'phone', 'id_card_number'];
    }
}
