<?php

namespace App\Filament\Resources\AdvertisementResource\Pages;

use App\Filament\Resources\AdvertisementResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListAdvertisements extends ListRecords
{
    protected static string $resource = AdvertisementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

        // protected function getHeaderWidgets(): array
        // {
        //     return [
        //         return AdvertisementResource\Widgets\AdvertisementResource::class,
        //     ];
        // }

        protected function getHeaderWidgets(): array
        {
            return AdvertisementResource::getWidgets();
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
