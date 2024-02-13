<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Vendor extends Model
{
    use HasFactory;
    use LogsActivity;


    public function user(): BelongsTo {
        return $this -> belongsTo(User::class);
    }

    public function vendorsocials(): HasMany {
        return $this -> hasMany(VendorSocial::class);
    }

    // public function vendortps(): HasMany {
    //     return $this -> hasMany(VendorTp::class);
    // }

    public function vendorfaqs(): HasMany {
        return $this -> hasMany(VendorFaq::class);
    }

    public function vendorpackage():HasOne {
        return $this -> hasOne(VendorPackage::class);
    }

    public function advertisements():HasMany {
        return $this -> hasMany(Advertisement::class);
    }

    public function topadss():HasMany {
        return $this -> hasMany(TopAds::class);
    }

    public function medias():HasMany {
        return $this -> hasMany(Media::class);
    }

    public function reviews(): HasMany {
        return $this -> hasMany(Review::class);
    }

    public function vendorgalleries(): HasMany {
        return $this -> hasMany(VendorGallery::class);
    }

    public function vendorpayments(): HasMany {
        return $this -> hasMany(VendorPayment::class);
    }


    public function vendorcategory(): BelongsTo {
        return $this -> belongsTo(VendorCategory::class);
    }

    public function adpackage(): HasMany {
        return $this -> hasMany(Adpackage::class);
    }

    public function clientvendorbookings(): HasMany {
        return $this -> hasMany(ClientVendorBooking::class);
    }

    protected $casts = [
        'v_bus_branches' => 'array',
        'v_category' => 'array',
        'v_phone' => 'array',

    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

}
