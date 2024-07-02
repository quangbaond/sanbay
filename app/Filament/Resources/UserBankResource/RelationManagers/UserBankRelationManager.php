<?php

namespace App\Filament\Resources\UserBankResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserBankRelationManager extends RelationManager
{
    protected static string $relationship = 'Banks';
    protected static ?string $label = 'Ngân hàng';
    protected static ?string $modelLabel = 'Ngân hàng';
    protected static ?string $title = 'Ngân hàng';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //bank name
                Forms\Components\TextInput::make('bank_name')
                    ->label('Tên ngân hàng')
                    ->required(),
                //bank account name
                Forms\Components\TextInput::make('bank_account_name')
                    ->label('Tên tài khoản')
                    ->required(),
                //bank branch
                Forms\Components\TextInput::make('bank_branch')
                    ->label('Chi nhánh')
                    ->required(),
                //bank account
                Forms\Components\TextInput::make('bank_account')
                    ->label('Số tài khoản')
                    ->required(),

                Forms\Components\FileUpload::make('id_card_before')
                    ->label('Ảnh mặt trước CMND')
                    ->image()
                    ->required(),
                Forms\Components\FileUpload::make('id_card_after')
                    ->label('Ảnh mặt sau CMND')
                    ->image()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user.username')
            ->columns([
                Tables\Columns\TextColumn::make('bank_name')
                    ->label('Tên ngân hàng'),
                Tables\Columns\TextColumn::make('bank_account_name')
                    ->label('Tên tài khoản'),
                Tables\Columns\TextColumn::make('bank_branch')
                    ->label('Chi nhánh'),
                Tables\Columns\TextColumn::make('bank_account')
                    ->label('Số tài khoản'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
