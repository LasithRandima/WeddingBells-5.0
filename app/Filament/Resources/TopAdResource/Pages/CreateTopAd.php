<?php

namespace App\Filament\Resources\TopAdResource\Pages;

use App\Filament\Resources\TopAdResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class CreateTopAd extends CreateRecord
{


    protected static string $resource = TopAdResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return auth()->user()->canAddTopAds();
    }


        public function mount(): void
    {
        abort_unless(auth()->user()->canAddTopAds(), 403);
    }




}
