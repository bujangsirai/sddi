<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Section;
use App\Models\Post;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Get;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Kelola User';
    protected static ?string $navigationGroup = 'Role dan Permission';
    protected static ?int $navigationSort = -1;

    protected static ?string $slug = 'user';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Fieldset::make('Informasi Akun')
                    ->schema([
                        TextInput::make('name')
                            ->label('Username')
                            ->required(),

                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable()
                            ->required(fn(string $context) => $context === 'create')
                            ->dehydrated(fn($state) => filled($state))
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->visible(fn(string $context) => $context === 'create'),

                        Select::make('roles')
                            ->multiple()
                            ->relationship('roles', 'name')
                            ->preload()
                            ->live(),

                        Select::make('kecamatan')
                            ->label('Kecamatan yang Diampu')
                            ->relationship('masterKecamatan', 'kecamatan')
                            ->multiple()
                            ->preload()
                            ->visible(fn(Get $get) => collect($get('roles'))->contains(3)),
                    ])
                    ->columns(1)
                    ->columnSpan(1),

                Fieldset::make('Detail Informasi Akun')
                    ->schema([
                        TextInput::make('email')
                            ->email()
                            ->required(),

                        TextInput::make('instansi')
                            ->required(),
                    ])
                    ->columns(1)
                    ->columnSpan(1)
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('instansi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('roles')
                    ->badge()
                    ->label('Role')
                    ->formatStateUsing(fn($state): string => __($state->name))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('masterKecamatan.kecamatan')
                    ->badge()
                    ->label('Kecamatan yang Diampu')
                    ->formatStateUsing(function ($state, $record) {
                        return $record->hasRole('Kecamatan') ? $state : '';
                    })
                    ->searchable()
                    ->sortable()

            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\EditAction::make()
                    ->label('Ubah Isian')
                    ->icon(''),

                Action::make('changePassword')
                    ->label('Ubah Password')
                    ->form([
                        TextInput::make('new_password')
                            ->label('Password Baru')
                            ->password()
                            ->required()
                            ->revealable()
                            ->confirmed()
                            ->validationMessages([
                                'confirmed' => 'Password yang anda masukkan tidak sama',
                            ]),

                        TextInput::make('new_password_confirmation')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->revealable()
                            ->required()
                    ])
                    ->action(function (User $record, array $data) {
                        $record->update([
                            'password' => Hash::make($data['new_password'])
                        ]);
                    }),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(
                null
            );
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
