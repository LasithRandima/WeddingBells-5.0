<?php

namespace App\Filament\Merchants\Resources\VendorTopAdResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\AttachAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdPacksRelationManager extends RelationManager
{
    protected static string $relationship = 'adPacks';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('v_id')->default(Auth::id()),
                // Hidden::make('ad_id')->default($lastrecord->pluck('id')->first() + 1),
                // Hidden::make('ad_id')->default($lastrecord->pluck('id')->first() + 1),


                Hidden::make('v_bus_name')->default(DB::table('vendors')
                    ->select('v_bus_name')
                    ->where('user_id', '=', Auth::id())
                    ->value('v_bus_name')),
                Hidden::make('actual_v_id')->default(DB::table('vendors')
                    ->select('id')
                    ->where('user_id', '=', Auth::id())
                    ->value('id')),

                // Forms\Components\TextInput::make('ad_id')
                //     ->label('Advertistment Name')
                //     ->required()
                //     ->maxLength(255),
                Forms\Components\TextInput::make('pkg_name')
                    ->label('Package Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label('Package Price')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                Forms\Components\MarkdownEditor::make('pkg_description')
                    ->label('Package Description')
                    ->required()
                    ->maxLength(3000)
                    ->columnSpan('full'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('pkg_name')
            ->columns([
                Tables\Columns\TextColumn::make('pkg_name')
                ->label('Package Name'),
                Tables\Columns\TextColumn::make('price')
                ->label('Package Price'),
                Tables\Columns\TextColumn::make('pkg_description')
                ->limit(25)
                ->label('Package Description'),
                Tables\Columns\TextColumn::make('order'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label("New Ad Package"),
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['pkg_name'])
                    ->recordSelect(
                        fn (Select $select) => $select->placeholder('Select a Package name'),
                    )
                    ->recordSelectOptionsQuery(fn (Builder $query) => $query->where('v_id', AUTH::id()))
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\TextInput::make('order')
                            ->label('Package Order')
                            ->numeric()
                            ->minValue(1)
                            ->required()
                            ->maxLength(255),

                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
