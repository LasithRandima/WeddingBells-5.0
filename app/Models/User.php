<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements FilamentUser, HasAvatar, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function advertistmentReviews(): BelongsToMany
    {
        return $this->belongsToMany(Advertisement::class)
            ->withTimestamps();
    }

    public function reviews(): HasMany {
        return $this -> hasMany(Review::class);
    }

    public function clienteventplanners(): HasMany {
        return $this -> hasMany(ClientEventPlanner::class);
    }

    public function advertisements():HasMany {
        return $this -> hasMany(Advertisement::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // var_dump($panel->getId());
        if ($panel->getId() == 'admin') {
            return $this->role_id === 1;
        }

        if ($panel->getId() === 'merchants') {
            return $this->role_id == 2;
        }



        return false;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->profile_photo_path;
    }

    public function getActivitylogOptions(): LogOptions
{
    return LogOptions::defaults()
        ->logFillable();
}


    public function canManageSettings(): bool{
            $package_id = DB::table('payments')->select('package_id')->where('v_id', '=', Auth::id())->value('package_id');
            $top_ads_limit = DB::table('payments')->select('top_ads_count')->where('v_id', '=', Auth::id())->value('top_ads_count');
            $Ads_Count = DB::table('advertisements')->select('id')->where('v_id', '=', Auth::id())->where('ad_type', '=', 1)->count();

            if($Ads_Count < $top_ads_limit){
                return true;
            }else{
                return false;
            }
    }



    public function canAddNormalAds(): bool
    {
        if(Auth::user()->role_id === 1){
            return true;
        }else{
            $package_id = DB::table('payments')->select('package_id')->where('v_id', '=', Auth::id())->value('package_id');
            $ads_limit = DB::table('payments')->select('ads_count')->where('v_id', '=', Auth::id())->value('ads_count');
            $Ads_Count = DB::table('advertisements')->select('id')->where('v_id', '=', Auth::id())->where('ad_type', '=', 0)->count();

            if($Ads_Count < $ads_limit){
                return true;
            }else{
                return false;
            }



        }

    }


    public function canAddTopAds(): bool
    {
            $package_id = DB::table('payments')->select('package_id')->where('v_id', '=', Auth::id())->value('package_id');
            $top_ads_limit = DB::table('payments')->select('top_ads_count')->where('v_id', '=', Auth::id())->value('top_ads_count');
            $Ads_Count = DB::table('advertisements')->select('id')->where('v_id', '=', Auth::id())->where('ad_type', '=', 1)->count();

            if($Ads_Count < $top_ads_limit){
                return true;
            }else{
                return false;
            }
    }


    public function canAddGalleryImages(): bool
    {
        if(Auth::user()->role_id === 1){
            return true;
        }else{
            $package_id = DB::table('payments')->select('package_id')->where('v_id', '=', Auth::id())->value('package_id');
            $image_limit = DB::table('payments')->select('image_count')->where('v_id', '=', Auth::id())->value('image_count');
            $image_Count = DB::table('vendor_galleries')->select('id')->where('v_id', '=', Auth::id())->count();

            if($image_Count < $image_limit){
                return true;
            }else{
                return false;
            }



        }

    }

}
