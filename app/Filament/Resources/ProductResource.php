<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $label = 'Dự án';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin cơ bản')
                ->schema([
                    Forms\Components\Select::make('category_id')
                        ->relationship('category', 'name')
                        ->required()
                        ->label('Danh mục'),
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->label('Tên dự án'),
                    Forms\Components\FileUpload::make('image')
                        ->directory('images/products')
                        ->columnSpanFull()
                        ->image()
                        ->previewable()
                        ->downloadable(true)
                        ->reorderable(true)
                        ->imageEditor(true)
                        ->openable(true)
                        ->label('Hình ảnh')
                        ->required(),
                    Forms\Components\TextInput::make('profit_everyday')
                        ->required()
                        ->numeric()
                        ->label('Lợi nhuận mỗi ngày'),
                    Forms\Components\TextInput::make('time_invest')
                        ->required()
                        ->numeric()
                        ->label('Thời gian đấu tầu'),
                    Forms\Components\TextInput::make('progress')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->label('Tiến độ'),
                    Forms\Components\TextInput::make('amount_total')
                        ->required()
                        ->numeric()
                        ->label('Số tiền cổ tức'),
                    Forms\Components\TextInput::make('amount_invested')
                        ->required()
                        ->numeric()
                        ->label('Số tiền quy mô dự án'),
                    Forms\Components\TextInput::make('min_invest')
                        ->required()
                        ->numeric()
                        ->label('Số tiền đầu tư tối thiểu'),
                    Forms\Components\Textarea::make('times_invest_decision')
                        ->required()
                        ->label('Thời gian giải quyết'),
                    Forms\Components\Textarea::make('book_invest')
                        ->label('Sổ đầu tư'),
                    Forms\Components\Textarea::make('security')
                        ->label('Bảo mật'),
                    Forms\Components\Textarea::make('description')
                        ->label('Mô tả'),
                    Forms\Components\Textarea::make('sort_description')
                        ->label('Mô tả ngắn'),
                    Forms\Components\Textarea::make('interest_risk')
                        ->label('Đấu thầu không có rủi ro'),
                    Forms\Components\Textarea::make('profit_calculation')
                        ->label('Tính toán lợi nhuận'),
                    Forms\Components\Select::make('status')
                        ->label('Trạng thái')
                        ->options([
                            0 => 'Khóa',
                            1 => 'Kích hoạt',
                        ]),

                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Tên dự án'),
                Tables\Columns\TextColumn::make('category.name')->label('Danh mục'),
                Tables\Columns\ImageColumn::make('image')->label('Hình ảnh'),
                Tables\Columns\TextColumn::make('profit_everyday')->label('Lợi nhuận mỗi ngày'),
                Tables\Columns\TextColumn::make('time_invest')->label('Thời gian đấu tầu'),
                Tables\Columns\TextColumn::make('progress')->label('Tiến độ'),
                Tables\Columns\TextColumn::make('amount_total')->label('Số tiền cổ tức'),
                Tables\Columns\TextColumn::make('amount_invested')->label('Số tiền quy mô dự án'),
                Tables\Columns\TextColumn::make('min_invest')->label('Số tiền đầu tư tối thiểu'),
                Tables\Columns\TextColumn::make('status')->label('Trạng thái'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
