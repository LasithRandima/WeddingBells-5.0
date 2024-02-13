<?php

namespace App\Filament\Merchants\Resources\VendorAdvertisementsResource\Pages;

use App\Filament\Merchants\Resources\VendorAdvertisementsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVendorAdvertisements extends EditRecord
{
    protected static string $resource = VendorAdvertisementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('View')->url(function (){
                if($this->getRecord()->isPublished()){
                    return route('advertistments.show', [$this->getRecord()]);
                }
                return route('advertisements.adpreview', [$this->getRecord()]);
            }),

        ];
    }
}
