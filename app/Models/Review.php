<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Review extends Pivot
{
    use HasFactory;

    protected $table = 'reviews';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vendor(): BelongsTo {
        return $this -> belongsTo(Vendor::class);
    }

    public function client(): BelongsTo {
        return $this -> belongsTo(Client::class);
    }

    public function advertisement(): BelongsTo {
        return $this -> belongsTo(Advertisement::class);
    }

    public function topadss(): BelongsTo {
        return $this -> belongsTo(TopAds::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class, 'ad_id');
    }
}
