<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientChecklist extends Model
{
    use HasFactory;


    public function client(): BelongsTo {
        return $this -> belongsTo(Client::class);
    }


    protected $fillable = ['c_id', 'task_name', 'description', 'Category', 'timing_period', 'date', 'essential', 'task_status'];
}
