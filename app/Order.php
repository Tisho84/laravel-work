<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    //protected $fillable = ['processed_on', 'shipped_on', 'expected_delivery_on', 'delivered_on', 'status_id'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    public function status()
    {
        return $this->belongsTo('App\OrderStatus');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_products');
    }

//    public function service()
//    {
//        return $this->belongsTo('App\Service');
//    }
}
