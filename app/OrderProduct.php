<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model {

	protected $table = 'order_products';
    public $timestamps = false;
    protected $guarded = array('order_id', 'product_id', 'quantity');

}
