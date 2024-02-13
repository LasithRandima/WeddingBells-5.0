<?php

namespace App\Filament\Merchants\Resources\VendorTopAdResource\Pages;

use App\Filament\Merchants\Resources\VendorTopAdResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVendorTopAd extends EditRecord
{
    protected static string $resource = VendorTopAdResource::class;

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
