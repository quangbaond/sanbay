<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserBankResource\RelationManagers\UserBankRelationManager;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $label = 'Người dùng';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin cơ bản')
                ->schema([
                    Forms\Components\TextInput::make('username')
                        ->label('Tên đăng nhập')
                        ->disabled(function ($record) {
                            return $record->exists;
                        }),
                    Forms\Components\Select::make('role')
                        ->label('Vai trò')
                        ->options([
                            0 => 'Admin',
                            1 => 'Người dùng',
                        ]),
                    Forms\Components\TextInput::make('balance')
                        ->label('Số dư'),
                    Forms\Components\Select::make('status')
                        ->label('Trạng thái')
                        ->options([
                            0 => 'Khóa',
                            1 => 'Kích hoạt',
                        ]),
                    Forms\Components\TextInput::make('id_card')
                        ->label('CMND'),
                ]),

                Forms\Components\Section::make('Mật khẩu')
                ->schema([
                    Forms\Components\TextInput::make('password')
                        ->label('Mật khẩu')
                        ->password()
                        ->required(function ($record) {
                            return !$record->exists;
                        }),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('username')->label('Tên đăng nhập'),
                Tables\Columns\SelectColumn::make('role')->label('Vai trò')
                    ->options([
                        0 => 'Admin',
                        1 => 'Người dùng',
                    ]),
                Tables\Columns\TextInputColumn::make('balance')->label('Số dư')
                ->rules([
                    'numeric',
                    'required',
                ])->type('number')
                ->beforeStateUpdated(function ($record, $state) {
                    $type = $state > $record->balance ? 1 : 2;
                    $amount = $state > $record->balance ? $state - $record->balance : $record->balance - $state;
                    $record->transactions()->create([
                        'amount' => $amount,
                        'user_id' => $record->id,
                        'type' => $type,
                        'status' => 1,
                        'payment_method' => 'Quản tri viên',
                        'description' => 'Cập nhật số dư',
                    ]);
                }),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Trạng thái')
                    ->options([
                        0 => 'Khóa',
                        1 => 'Kích hoạt',
                    ]),
                //id card
                Tables\Columns\TextColumn::make('id_card')->label('CMND'),
                Tables\Columns\TextColumn::make('created_at')->label('Ngày tạo'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UserBankRelationManager::class
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
