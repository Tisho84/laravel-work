<?php namespace App;

use App\Classes\AddressType;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $table = 'addresses';

    protected $fillable = array('street', 'city', 'zip', 'country', 'type');

    public function order()
    {
        return $this->hasOne('App\Order');
    }

    public function getAddress()
    {
        return AddressType::getType($this->type);
    }

}
