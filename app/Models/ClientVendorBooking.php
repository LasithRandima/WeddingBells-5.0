<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ClientVendorBooking extends Model
{
    use HasFactory;
    use LogsActivity;

    public function client(): BelongsTo {
        return $this->belongsTo(Client::class, 'c_id', 'id');
    }

    public function vendor(): BelongsTo {
        return $this->belongsTo(Vendor::class, 'v_id', 'id');
    }

    // public function advertisement(): BelongsTo {
    //     return $this -> belongsTo(Advertisement::class);
    // }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'ad_id', 'id');
    }

    public function adpackage()
    {
        return $this->belongsTo(Adpackage::class, 'pkg_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
}
