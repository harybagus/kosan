<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $navigationIcon  = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Manajemen User';
    protected static ?string $modelLabel      = 'User';
    protected static ?string $pluralModelLabel = 'User';
    protected static ?int    $navigationSort  = 10;

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view_users') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create_users') ?? false;
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->user()?->can('edit_users') ?? false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        $user = request()->user();

        if ($user && $user->id === $record->id) {
            return false;
        }

        return $user && $user->can('delete_users');
    }

    // =========================================================
    // FORM
    // =========================================================
    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Informasi User')
                ->icon('heroicon-o-user')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->placeholder(fn(string $operation) => $operation === 'edit' ? 'Kosongkan jika tidak diubah' : null),

                        Forms\Components\Select::make('role')
                            ->label('Role (Legacy)')
                            ->options([
                                'admin' => 'Admin',
                                'staff' => 'Staff',
                            ])
                            ->default('staff')
                            ->required(),

                    ]),
                ]),

            Forms\Components\Section::make('Hak Akses (Spatie)')
                ->description('Assign role untuk mengatur hak akses')
                ->icon('heroicon-o-shield-check')
                ->schema([
                    Forms\Components\Select::make('roles')
                        ->label('Role')
                        ->multiple()
                        ->relationship('roles', 'name')
                        ->options(
                            Role::all()->mapWithKeys(fn($role) => [
                                $role->id => match ($role->name) {
                                    'super_admin' => 'Super Admin — Akses Penuh',
                                    'admin'       => 'Admin — Semua Fitur',
                                    'staff'       => 'Staff — Operasional Dasar',
                                    default       => $role->name,
                                },
                            ])
                        )
                        ->preload(),
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
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('roles.name')
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

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Role')
                    ->options([
                        'admin' => 'Admin',
                        'staff' => 'Staff',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Lihat'),
                Tables\Actions\EditAction::make()->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus User')
                    ->modalDescription('Yakin ingin menghapus user ini?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->visible(fn($record) => request()->user()?->id !== $record->id),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Hapus yang dipilih'),
                ]),
            ])
            ->emptyStateIcon('heroicon-o-users')
            ->emptyStateHeading('Belum ada user')
            ->emptyStateDescription('Tambahkan user pertama untuk mengakses sistem.');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view'   => Pages\ViewUser::route('/{record}'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
