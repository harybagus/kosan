<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Manajemen Pembayaran';

    protected static ?string $modelLabel = 'Pembayaran';

    protected static ?string $pluralModelLabel = 'Pembayaran';

    protected static ?int $navigationSort = 3;

    // =========================================================
    // FORM
    // =========================================================
    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Informasi Pembayaran')
                ->description('Data pembayaran sewa kamar')
                ->icon('heroicon-o-banknotes')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([

                        Forms\Components\Select::make('tenant_id')
                            ->label('Penghuni')
                            ->required()
                            ->options(
                                Tenant::with('room')
                                    ->where('status', 'active')
                                    ->get()
                                    ->mapWithKeys(fn(Tenant $tenant) => [
                                        $tenant->id => "{$tenant->name} — Kamar {$tenant->room->room_number}",
                                    ])
                            )
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function (Set $set, ?int $state) {
                                if ($state) {
                                    $tenant = Tenant::with('room')->find($state);
                                    if ($tenant) {
                                        $set('room_id', $tenant->room_id);
                                        $set('amount', $tenant->room->price);
                                    }
                                }
                            }),

                        Forms\Components\Select::make('room_id')
                            ->label('Kamar')
                            ->required()
                            ->options(
                                Room::all()->mapWithKeys(fn(Room $room) => [
                                    $room->id => "Kamar {$room->room_number}",
                                ])
                            )
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('amount')
                            ->label('Jumlah Tagihan')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0),

                        Forms\Components\Select::make('status')
                            ->label('Status Pembayaran')
                            ->required()
                            ->options([
                                'pending'  => 'Pending',
                                'due_soon' => 'Jatuh Tempo',
                                'overdue'  => 'Terlambat',
                                'paid'     => 'Lunas',
                            ])
                            ->default('pending')
                            ->live(),

                        Forms\Components\DatePicker::make('due_date')
                            ->label('Tanggal Jatuh Tempo')
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->default(now()->addMonth()->startOfMonth()),

                        Forms\Components\DatePicker::make('paid_date')
                            ->label('Tanggal Dibayar')
                            ->displayFormat('d/m/Y')
                            ->visible(fn(Get $get) => $get('status') === 'paid')
                            ->nullable(),

                    ]),
                ]),

            Forms\Components\Section::make('Detail Pembayaran')
                ->description('Metode dan bukti pembayaran')
                ->icon('heroicon-o-credit-card')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([

                        Forms\Components\Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'cash'     => 'Tunai',
                                'transfer' => 'Transfer',
                                'qris'     => 'QRIS',
                            ])
                            ->nullable(),

                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan')
                            ->placeholder('Catatan tambahan...')
                            ->rows(3),

                    ]),

                    Forms\Components\FileUpload::make('proof_image')
                        ->label('Bukti Pembayaran')
                        ->image()
                        ->disk('public')
                        ->directory('payments/proof')
                        ->visibility('public')
                        ->imagePreviewHeight('200')
                        ->panelLayout('integrated')
                        ->columnSpanFull(),
                ])
                ->collapsed(),

        ]);
    }

    // =========================================================
    // TABLE
    // =========================================================
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('tenant.name')
                    ->label('Penghuni')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('room.room_number')
                    ->label('Kamar')
                    ->formatStateUsing(fn(string $state): string => 'Kamar ' . $state)
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('due_date')
                    ->label('Jatuh Tempo')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('paid_date')
                    ->label('Tanggal Bayar')
                    ->date('d M Y')
                    ->placeholder('—')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
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
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'pending'  => 'heroicon-o-clock',
                        'due_soon' => 'heroicon-o-exclamation-triangle',
                        'overdue'  => 'heroicon-o-x-circle',
                        'paid'     => 'heroicon-o-check-circle',
                        default    => 'heroicon-o-question-mark-circle',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode')
                    ->formatStateUsing(fn(?string $state): string => match ($state) {
                        'cash'     => 'Tunai',
                        'transfer' => 'Transfer',
                        'qris'     => 'QRIS',
                        default    => '—',
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending'  => 'Pending',
                        'due_soon' => 'Jatuh Tempo',
                        'overdue'  => 'Terlambat',
                        'paid'     => 'Lunas',
                    ]),

                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options([
                        'cash'     => 'Tunai',
                        'transfer' => 'Transfer',
                        'qris'     => 'QRIS',
                    ]),

                Tables\Filters\Filter::make('due_this_month')
                    ->label('Jatuh Tempo Bulan Ini')
                    ->query(
                        fn(Builder $query) => $query
                            ->whereMonth('due_date', now()->month)
                            ->whereYear('due_date', now()->year)
                    ),

            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat'),

                Tables\Actions\EditAction::make()
                    ->label('Edit'),

                // Aksi cepat tandai lunas
                Tables\Actions\Action::make('mark_paid')
                    ->label('Tandai Lunas')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Pembayaran Lunas')
                    ->modalDescription('Konfirmasi pembayaran ini sudah diterima?')
                    ->modalSubmitActionLabel('Ya, Tandai Lunas')
                    ->visible(fn(Payment $record) => $record->status !== 'paid')
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

                Tables\Actions\DeleteAction::make()
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                    // Bulk tandai lunas
                    Tables\Actions\BulkAction::make('bulk_mark_paid')
                        ->label('Tandai Lunas')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Tandai Lunas Semua Terpilih')
                        ->modalSubmitActionLabel('Ya, Tandai Lunas')
                        ->action(function ($records) {
                            $records->each(function (Payment $record) {
                                if ($record->status !== 'paid') {
                                    $record->update([
                                        'status'    => 'paid',
                                        'paid_date' => now(),
                                    ]);
                                }
                            });

                            \Filament\Notifications\Notification::make()
                                ->title('Pembayaran berhasil ditandai lunas')
                                ->success()
                                ->send();
                        }),

                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus yang dipilih')
                        ->after(function (Collection $records) {
                            foreach ($records as $record) {
                                if ($record->proof_image) {
                                    Storage::disk('public')->delete($record->proof_image);
                                }
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Pembayaran Terpilih')
                        ->modalDescription('Yakin ingin menghapus semua pembayaran yang dipilih?')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->defaultSort('due_date', 'asc')
            ->emptyStateIcon('heroicon-o-banknotes')
            ->emptyStateHeading('Belum ada data pembayaran')
            ->emptyStateDescription('Mulai dengan menambahkan tagihan pembayaran.')
            ->emptyStateActions([
                Tables\Actions\Action::make('create')
                    ->label('Tambah Pembayaran')
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
            'index'  => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'view'   => Pages\ViewPayment::route('/{record}'),
            'edit'   => Pages\EditPayment::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['tenant.name', 'notes'];
    }
}
