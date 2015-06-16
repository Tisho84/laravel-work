<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $table = 'addresses';

    protected $fillable = array('street', 'city', 'zip', 'country');

    public function type()
    {
        return $this->belongsTo('App\AddressType');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}
