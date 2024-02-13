<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Advertisement extends Model
{
    use HasFactory;
    use LogsActivity;


    public function vendor(): BelongsTo {
        return $this -> belongsTo(Vendor::class, 'actual_v_id');
    }

    public function user(): BelongsTo {
        return $this -> belongsTo(Vendor::class, 'v_id');
    }

    public function reviews(): HasMany {
        return $this->hasMany(Review::class, 'ad_id'); // 'ad_id' is the actual foreign key column name
    }

    public function category(): BelongsTo  {
        return $this -> belongsTo(VendorCategory::class);
    }

    public function bookings(): HasMany {
        return $this -> hasMany(ClientVendorBooking::class);
    }

    // public function adpackages(): HasMany {
    //     return $this -> hasMany(Adpackage::class, 'ad_id');
    // }

    public function adpacks(): BelongsToMany {
        return $this -> belongsToMany(Adpackage::class, 'advertistment_packages')->withPivot(['order'])->withTimestamps();
    }


    protected $casts = [
        'v_bus_branches' => 'array',
        'meta_tags' => 'array',

    ];

    // public function users(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class)
    //         ->using(Review::class)
    //         ->as('review')
    //         ->withPivot([
    //             'review',
    //             'rating',
    //         ])
    //         ->withTimestamps()
    //         ->latest('review.created_at');
    // }


    // public function users(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'reviews', 'ad_id', 'c_id') // Specify the correct foreign key names
    //         ->using(Review::class)
    //         ->as('review')
    //         ->withPivot([
    //             'review',
    //             'rating',
    //         ])
    //         ->withTimestamps()
    //         ->latest('reviews.created_at');
    // }


    // public function users(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'reviews', 'ad_id', 'c_id') // Specify the correct foreign key names
    //         ->using(Review::class)
    //         ->as('review')
    //         ->withPivot([
    //             'review',
    //             'rating',
    //         ])
    //         ->withTimestamps()
    //         ->whereNotNull('reviews.ad_id') // Ensure ad_id is not null
    //         ->latest('reviews.created_at');
    // }


    public function users(): BelongsToMany
{
    return $this->belongsToMany(User::class, 'reviews', 'ad_id', 'c_id') // Specify the correct foreign key names
        ->using(Review::class)
        ->as('review')
        ->withPivot([
            'id as review_id',
            'review',
            'rating',
        ])
        ->withTimestamps()
        ->whereNotNull('reviews.ad_id') // Ensure ad_id is not null
        ->latest('reviews.created_at');
}

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    public function isPublished(){
        return $this->approrval_status === 'published';
    }


}
