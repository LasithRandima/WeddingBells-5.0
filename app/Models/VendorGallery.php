<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class VendorGallery extends Model
{
    use HasFactory;


    public function vendor(): BelongsTo {
        return $this -> belongsTo(Vendor::class);
    }

    protected static function booted(): void
    {
       self::deleting(function (VendorGallery $vendorGallery) {
            // $vendorGallery->image_path->delete();
            Storage::disk('public')->delete($vendorGallery->image_path);
        });
    }
}
