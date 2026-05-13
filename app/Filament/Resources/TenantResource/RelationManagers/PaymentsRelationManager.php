<?php

namespace App\Filament\Resources\TenantResource\RelationManagers;

use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';
    protected static ?string $title       = 'Riwayat Pembayaran';

    public function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Grid::make(2)->schema([

                Forms\Components\TextInput::make('amount')
                    ->label('Jumlah')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        'pending'  => 'Pending',
                        'due_soon' => 'Jatuh Tempo',
                        'overdue'  => 'Terlambat',
                        'paid'     => 'Lunas',
                    ])
                    ->default('pending'),

                Forms\Components\DatePicker::make('due_date')
                    ->label('Tanggal Jatuh Tempo')
                    ->required()
                    ->displayFormat('d/m/Y'),

                Forms\Components\DatePicker::make('paid_date')
                    ->label('Tanggal Dibayar')
                    ->displayFormat('d/m/Y')
                    ->nullable(),

                Forms\Components\Select::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options([
                        'cash'     => 'Tunai',
                        'transfer' => 'Transfer Bank',
                        'qris'     => 'QRIS',
                    ])
                    ->nullable(),

                Forms\Components\Textarea::make('notes')
                    ->label('Catatan')
                    ->rows(2),

            ]),

        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([

                Tables\Columns\TextColumn::make('due_date')
                    ->label('Jatuh Tempo')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR')
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
                    }),

                Tables\Columns\TextColumn::make('paid_date')
                    ->label('Tanggal Bayar')
                    ->date('d M Y')
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode')
                    ->formatStateUsing(fn(?string $state): string => match ($state) {
                        'cash'     => 'Tunai',
                        'transfer' => 'Transfer Bank',
                        'qris'     => 'QRIS',
                        default    => '—',
                    }),

            ])
            ->defaultSort('due_date', 'desc')
            ->recordClasses(fn(Payment $record) => match ($record->status) {
                'overdue'  => 'bg-red-50 dark:bg-red-950/30 border-l-4 border-l-red-500',
                'due_soon' => 'bg-yellow-50 dark:bg-yellow-950/30 border-l-4 border-l-yellow-500',
                default    => '',
            })
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending'  => 'Pending',
                        'due_soon' => 'Jatuh Tempo',
                        'overdue'  => 'Terlambat',
                        'paid'     => 'Lunas',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Pembayaran')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['room_id'] = $this->ownerRecord->room_id;
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_paid')
                    ->label('Tandai Lunas')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Pembayaran Lunas')
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

                Tables\Actions\EditAction::make()
                    ->label('Edit'),

                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->emptyStateHeading('Belum ada riwayat pembayaran')
            ->emptyStateDescription('Tambahkan pembayaran pertama untuk penghuni ini.')
            ->emptyStateIcon('heroicon-o-banknotes');
    }
}
