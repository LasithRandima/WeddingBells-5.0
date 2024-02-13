<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SitePackage extends Model
{
    use HasFactory;


    public function vendorpackages(): BelongsToMany {
        return $this -> belongsToMany(VendorPackage::class);
    }

    public function vendorpayments(): BelongsToMany {
        return $this -> belongsToMany(VendorPayment::class);
    }

    public function payments(): BelongsToMany {
        return $this -> belongsToMany(Payment::class);
    }
}
