<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $table = 'products';

    protected $fillable = array('name', 'available', 'quantity', 'active', 'category_id', 'description', 'price');

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeAvailable($query)
    {
        return $query->where('available', 1);
    }

    public function scopeQuantity($query)
    {
        return $query->where('quantity', '>', 0);
    }

    public function scopeSell($query)
    {
        return $query->where('active', 1)
            ->where('available', 1)
            ->where('quantity', '>', 1);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function orders()
    {
        //only order_id and product_id listed at attributes when using pivot
        return $this->belongsToMany('App\Order', 'order_products')->withPivot(['quantity', 'id']);
    }

}
