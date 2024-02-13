<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientGuestList extends Model
{
    use HasFactory;

    protected $fillable = ['guest_name', 'contact_no', 'email', 'no_of_family_members', 'drinking_buddies_count', 'group', 'status'];

    public function client():BelongsTo {
        return $this -> belongsTo(Client::class);
    }
}
