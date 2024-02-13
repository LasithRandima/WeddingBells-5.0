<?php

namespace App\Filament\Merchants\Resources\VendorGalleryResource\Pages;

use App\Filament\Merchants\Resources\VendorGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVendorGallery extends EditRecord
{
    protected static string $resource = VendorGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('View Photo Collage')->url(function (){
                // if($this->getRecord()->isPublished()){
                //     return route('advertistments.show', [$this->getRecord()]);
                // }
                return route('photocollage');
            }),

        ];
    }
}
