<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'organization', 'city', 'country', 'state', 'industry_type', 'primary_commodity', 'cargo_types', 'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'is_admin', 'stripe_id', 'card_brand', 'card_last_four', 'trial_ends_at',
    ];

    protected $dates = [
        'trial_ends_at',
    ];
   
    public function is_subscribed() {
        return $this->subscribed('main');
    }

    public function privacy_settings() {
        return $this->hasOne('App\PrivacySettings');
    }

    public function trial_days_left() {
        $today = \Carbon\Carbon::today();
        return $today->diffInDays($this->trial_ends_at);
    }

}
