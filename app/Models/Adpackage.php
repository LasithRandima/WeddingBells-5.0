<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adpackage extends Model
{
    use HasFactory;

    public function vendor(): BelongsTo {
        return $this -> belongsTo(Vendor::class);
    }

    // public function advertisement(): BelongsTo {
    //     return $this -> belongsTo(Advertisement::class);
    // }

    public function advertisements(): BelongsToMany {
        return $this -> belongsToMany(Advertisement::class, 'advertistment_packages')->withPivot(['order'])->withTimestamps();
    }

    public function clientvendorbookings(): HasMany {
        return $this -> hasMany(ClientVendorBooking::class);
    }
}
