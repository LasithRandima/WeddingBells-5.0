<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuestList extends Model
{
    use HasFactory;

    protected $table = 'guest_lists';

    // public function guestCompanions(): HasMany {
    //     return $this -> hasMany(GuestCompanion::class);
    // }

    public function guestCompanions(): HasMany {
        return $this->hasMany(GuestCompanion::class, 'guest_id', 'id');
    }

    public function guestConfirms(): BelongsTo  {
        return $this -> belongsTo(GuestConfirm::class);
    }

    public function client():BelongsTo {
        return $this -> belongsTo(Client::class);
    }

    protected $casts = [
        'invited_to' => 'array',

    ];
}
