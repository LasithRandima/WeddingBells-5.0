<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorCategory extends Model
{
    use HasFactory;


    public function vendors(): HasMany {
        return $this -> hasMany(Vendor::class);
    }

    public function advertisements(): HasMany {
        return $this -> hasMany(Advertisement::class);
    }

    public function topadss(): HasMany {
        return $this -> hasMany(TopAds::class);
    }
}
