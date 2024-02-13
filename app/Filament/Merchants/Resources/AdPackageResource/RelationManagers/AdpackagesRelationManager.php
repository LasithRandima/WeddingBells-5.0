<?php

namespace App\Filament\Merchants\Resources\AdPackageResource\RelationManagers;

use App\Models\Advertisement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Hidden;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdpackagesRelationManager extends RelationManager
{
    protected static string $relationship = 'adpackages';

    public function form(Form $form): Form
    {
        // $lastrecord = Advertisement::latest()->get();
        return $form
            ->schema([

                    Hidden::make('v_id')->default(Auth::id()),
                    // Hidden::make('ad_id')->default($lastrecord->pluck('id')->first() + 1),

                    Hidden::make('v_bus_name')->default(DB::table('vendors')
                        ->select('v_bus_name')
                        ->where('user_id', '=', Auth::id())
                        ->value('v_bus_name')),
                    Hidden::make('actual_v_id')->default(DB::table('vendors')
                        ->select('id')
                        ->where('user_id', '=', Auth::id())
                        ->value('id')),


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
                Tables\Columns\TextColumn::make('pkg_name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                // Tables\Actions\AttachAction::make(),
                Tables\Actions\AssociateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                // Tables\Actions\DetachAction::make(),
                Tables\Actions\DissociateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
