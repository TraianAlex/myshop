<?php

namespace App;

//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Laravel\Cashier\Billable;
//use Laravel\Cashier\Contracts\Billable as BillableContract;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Cashier\Billable;
//use Laravel\Cashier\Contracts\Billable as BillableContract; //, BillableContract

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
//class User extends Model
{
    use Authenticatable, CanResetPassword, Billable;
    //use Billable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'address', 'city', 'state', 'zip'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['trial_ends_at', 'subscription_ends_at'];

    /**
     * Get a users cart. These are items to the cart that
     * that haven't been paid for yet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cart()
    {
        return $this->hasMany('App\Cart')->where('complete', 0);
    }
}
