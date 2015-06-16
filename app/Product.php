<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $table = 'products';

    protected $fillable = array('name', 'available', 'quantity', 'active', 'category_id');

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order', 'order_products');
    }

}
