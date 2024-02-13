<?php

namespace App\Models;

use App\Models\Review;
use App\Models\Vendor;
use App\Models\VendorCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class TopAd extends Model
{
    use HasFactory;
    protected $table = 'top_ads';

    public function vendor(): BelongsTo {
        return $this -> belongsTo(Vendor::class);
    }

    public function reviews(): HasMany {
        return $this -> hasMany(Review::class);
    }

    public function category(): BelongsTo  {
        return $this -> belongsTo(VendorCategory::class);
    }


    protected $casts = [
        'v_bus_branches' => 'array',

    ];
}
