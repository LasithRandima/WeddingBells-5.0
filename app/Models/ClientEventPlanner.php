<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientEventPlanner extends Model
{
    use HasFactory;

    protected $fillable = ['c_id', 'event_title', 'event_desc', 'event_start_date', 'event_end_date', 'event_start_time', 'responsible_person'];

    public function user():BelongsTo {
        return $this->belongsTo(User::class, 'c_id', 'id');
    }
}
