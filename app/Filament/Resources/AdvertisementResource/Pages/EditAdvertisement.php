<?php

namespace App\Filament\Resources\AdvertisementResource\Pages;

use App\Filament\Resources\AdvertisementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Filament\Forms\Components\Component;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;
use Pboivin\FilamentPeek\Pages\Concerns\HasBuilderPreview;

class EditAdvertisement extends EditRecord
{
    use HasPreviewModal;
    use HasBuilderPreview;

    protected static string $resource = AdvertisementResource::class;

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

    protected function getBuilderPreviewView(string $builderName): ?string
    {
        return 'posts.preview-blocks';
    }

    public static function getBuilderEditorSchema(string $builderName): Component|array
    {
        return AdvertisementResource::contentBuilderField(context: 'preview');
    }


}
