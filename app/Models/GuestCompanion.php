<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuestCompanion extends Model
{
    use HasFactory;

    public function guestLists(): BelongsTo {
        return $this ->  belongsTo(GuestList::class);
    }

    public function guestConfirms(): BelongsTo {
        return $this -> belongsTo(GuestConfirm::class);
    }

    public function client():BelongsTo {
        return $this -> belongsTo(Client::class);
    }


    protected $casts = [
        'invited_to' => 'array',

    ];
}
