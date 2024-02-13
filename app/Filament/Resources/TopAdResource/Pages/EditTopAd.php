<?php

namespace App\Filament\Resources\TopAdResource\Pages;

use App\Filament\Resources\TopAdResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopAd extends EditRecord
{
    protected static string $resource = TopAdResource::class;

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
