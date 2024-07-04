<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvestResource\Pages;
use App\Filament\Resources\InvestResource\RelationManagers;
use App\Models\Invest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvestResource extends Resource
{
    protected static ?string $model = Invest::class;

    protected static ?string $label = 'Đầu tư';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin cơ bản')
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->relationship('user', 'username')
                        ->required()
                        ->label('Tài khoản'),
                    Forms\Components\TextInput::make('amount')
                        ->required()
                        ->label('Số tiền'),
                    Forms\Components\Select::make('status')
                        ->options([
                            0 => 'Chờ xử lý',
                            1 => 'Thành công',
                            2 => 'Hủy bỏ',
                        ])
                        ->required()
                        ->label('Trạng thái'),
                    Forms\Components\Select::make('product_id')
                        ->relationship('product', 'name')
                        ->required()
                        ->label('Dự án'),
                    Forms\Components\DateTimePicker::make('completed_at')
                        ->required()
                        ->label('Thời gian hoàn thành'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label('Tài khoản')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')->label('Số tiền'),
                Tables\Columns\SelectColumn::make('status')->label('Trạng thái')
                ->options([
                    0 => 'Chờ xử lý',
                    1 => 'Xác nhận',
                    2 => 'Thành công',
                    3 => 'Hủy bỏ',
                ])->afterStateUpdated(function ($record, $state) {
                    switch ($state) {
                        case 1:
                            $record->accept_at = now();
                            $record->save();
                            break;
                        case 2:
                            // loi nhuan bằng số tiền đầu tư * % lợi nhuận
                            $loi_nhuan = $record->amount * $record->product->profit_everyday / 100;
                            $record->user->balance += $record->amount + $loi_nhuan;
                            $record->completed_at = now();
                            $record->user->save();
                            $record->save();
                            break;
                        case 3:
                            $record->user->balance += $record->amount;
                            $record->user->save();
                            break;
                    }
                }),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Dự án')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvests::route('/'),
            'create' => Pages\CreateInvest::route('/create'),
            'edit' => Pages\EditInvest::route('/{record}/edit'),
        ];
    }
}
