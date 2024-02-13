<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AllGuest extends Model
{
    use HasFactory;

    protected $table = 'all_guests';

    public function guestCompanions(): HasMany {
        return $this->hasMany(GuestCompanion::class, 'guest_id', 'id');
    }
}
