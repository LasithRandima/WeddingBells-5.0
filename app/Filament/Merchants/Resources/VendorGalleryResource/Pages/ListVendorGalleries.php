<?php

namespace App\Filament\Merchants\Resources\VendorGalleryResource\Pages;

use App\Filament\Merchants\Resources\VendorGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVendorGalleries extends ListRecords
{
    protected static string $resource = VendorGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('View Photo Collage')->url(function (){
                // if($this->getRecord()->isPublished()){
                //     return route('advertistments.show', [$this->getRecord()]);
                // }
                return route('photocollage');
            }),
            Actions\CreateAction::make(),
        ];
    }


}
