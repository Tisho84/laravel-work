<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = ['user_id', 'processed_on', 'shipped_on', 'expected_delivery_on', 'delivered_on', 'status_id'];

    protected $dates = ['processed_on', 'shipped_on', 'expected_delivery_on', 'delivered_on', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
        //return $this->hasOne('App\Address');
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment');
        //return $this->hasOne('App\Payment');
    }

    public function status()
    {
        return $this->belongsTo('App\OrderStatus');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_products')->withPivot(['quantity', 'id']);
    }

//    public function service()
//    {
//        return $this->belongsTo('App\Service');
//    }
}
