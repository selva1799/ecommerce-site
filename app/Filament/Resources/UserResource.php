<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    // protected static ?string $navigationGroup = 'User Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->minLength(3)
                            ->regex('/^[a-zA-Z\s]+$/')
                            ->validationMessages([
                                'required' => 'The name field is required',
                                'min' => 'Name must be at least 3 characters',
                                'regex' => 'Name can only contain letters and spaces',
                            ]),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->validationMessages([
                                'required' => 'The email field is required',
                                'email' => 'Please enter a valid email address',
                                'unique' => 'This email is already in use',
                            ]),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->rule(Password::default())
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->maxLength(255)
                            ->validationMessages([
                                'required' => 'The password field is required',
                            ]),
                        Forms\Components\Select::make('role_id')
                            ->label('Role')
                            ->relationship('role', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->default(2)
                            ->hidden(fn (): bool => ! auth()->user()->isAdmin())
                            ->validationMessages([
                                'required' => 'Please select a role',
                            ]),
                    ])->columns(2),
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(20)
                            ->regex('/^[0-9\+\-\s]+$/')
                            ->validationMessages([
                                'regex' => 'Please enter a valid phone number',
                            ]),
                        Forms\Components\Textarea::make('address')
                            ->maxLength(65535)
                            ->columnSpanFull()
                            ->minLength(5)
                            ->validationMessages([
                                'min' => 'Address should be at least 5 characters',
                            ]),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role.name')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->relationship('role', 'name')
                    ->hidden(fn (): bool => ! auth()->user()->isAdmin()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
               // In your table actions:
                Tables\Actions\DeleteAction::make()
                ->hidden(fn (User $record): bool => $record->role_id === 1 && ! auth()->user()->isAdmin())
                ->action(function (User $record) {
                    try {
                        $record->delete();
                        Notification::make()
                            ->title('User deleted successfully')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Error deleting user')
                            ->danger()
                            ->send();
                        throw $e;
                    }
                }),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->hidden(fn (): bool => ! auth()->user()->isAdmin()),
                ]),
            ]);
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

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
