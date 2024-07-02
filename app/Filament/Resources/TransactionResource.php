<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $label = 'Giao dịch';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin giao dịch')
                ->schema([
                    Forms\Components\TextInput::make('amount')
                        ->label('Số tiền')
                        ->numeric()
                        ->required(),
                    Forms\Components\Select::make('type')
                        ->label('Phương thức')
                        ->options([
                            1 => 'Nạp tiền',
                            2 => 'Rút tiền',
                        ])
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->label('Trạng thái')
                        ->options([
                            0 => 'Chờ xử lý',
                            1 => 'Thành công',
                            2 => 'Thất bại',
                        ])
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->label('Mô tả')
                        ->required(),
                    Forms\Components\Select::make('user_id')
                        ->relationship('user', 'username')
                        ->label('Người dùng')
                        ->required(),
                    Forms\Components\Select::make('user_bank_id')
                        ->label('Ngân hàng')
                        ->relationship('userBank', 'bank_name')
                        ->required()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Số tiền')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => number_format($state) . ' VND')
                    ->sortable(),
                Tables\Columns\SelectColumn::make('type')
                    ->label('Phương thức')
                    ->options([
                        1 => 'Nạp tiền',
                        2 => 'Rút tiền',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        0 => 'Chờ xử lý',
                        1 => 'Thành công',
                        2 => 'Thất bại',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Mô tả')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('userBank.bank_name')
                    ->label('Ngân hàng')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Thời gian')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //filter type
                Tables\Filters\SelectFilter::make('type')
                    ->label('Phương thức')
                    ->options([
                        1 => 'Nạp tiền',
                        2 => 'Rút tiền',
                    ]),
                //filter status
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        0 => 'Chờ xử lý',
                        1 => 'Thành công',
                        2 => 'Thất bại',
                    ]),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
