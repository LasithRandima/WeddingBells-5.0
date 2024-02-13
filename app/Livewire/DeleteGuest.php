<?php

namespace app\Livewire;

use App\Models\ClientGuestList;
use LivewireUI\Modal\ModalComponent;

class DeleteDish extends ModalComponent
{
    public ?int $guestId = null;

    public array $guestIds = [];

    public string $confirmationTitle = '';

    public string $confirmationDescription = '';

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function confirm()
    {
        if ($this->guestId) {
            ClientGuestList::query()->find($this->guestId)->delete();
        }

        if ($this->guestIds) {
            ClientGuestList::query()->whereIn('id', $this->guestIds)->delete();
        }

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }

    public function render()
    {
        return view('livewire.delete-guest');
    }
}
