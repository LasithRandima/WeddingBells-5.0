<?php

namespace App\Filament\Resources\TopAdResource\Pages;

use App\Filament\Resources\TopAdResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTopAds extends ListRecords
{
    protected static string $resource = TopAdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return TopAdResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => ListRecords\Tab::make('All'),
            'pending_approval' => ListRecords\Tab::make()->query(fn ($query) => $query->where('approrval_status', 'pending_approval')),
            'reviewing' => ListRecords\Tab::make()->query(fn ($query) => $query->where('approrval_status', 'reviewing')),
            'published' => ListRecords\Tab::make()->query(fn ($query) => $query->where('approrval_status', 'published')),
            'rejected' => ListRecords\Tab::make()->query(fn ($query) => $query->where('approrval_status', 'rejected')),
            'draft' => ListRecords\Tab::make()->query(fn ($query) => $query->where('approrval_status', 'draft')),
        ];
    }
}
