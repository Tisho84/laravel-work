<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

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
    protected $fillable = ['first_name', 'last_name', 'username', 'phone', 'email', 'password', 'active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     *  User is authorized to see order
     */
    public function isAuthorized(Order $order) #order belong to
    {
        $flag = true;
        if (!$this->is_admin) { #check if user has that order
            $flag = $this->orders()->find($order->id);
            if( $flag ) {
                return $flag->first();
            }
        }
        return $flag;
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getName()
    {
        return $this->fisrt_name . ' ' . $this->last_name;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            return $this->attributes['password'] = Hash::make($value);
        }
    }
}
