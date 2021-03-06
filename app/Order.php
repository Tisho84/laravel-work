<?php namespace App;

use App\Classes\OrderStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model {

    protected $fillable = ['user_id', 'processed_on', 'shipped_on', 'expected_delivery_on', 'delivered_on', 'status', 'address_id', 'is_paid'];

    protected $dates = ['processed_on', 'shipped_on', 'expected_delivery_on', 'delivered_on', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function products()
    {
        //only order_id and product_id listed at attributes when using pivot
        return $this->belongsToMany('App\Product', 'order_products')->withPivot(['quantity', 'id']);
    }

    public function getProcessedOnAttribute($value)
    {
        return getCarbonDate($value);
    }

    public function getShippedOnAttribute($value)
    {
        return getCarbonDate($value);
    }

    public function getExpectedDeliveryOnAttribute($value)
    {
        return getCarbonDate($value);
    }

    public function getDeliveredOnAttribute($value)
    {
        return getCarbonDate($value);
    }

    public function getStatus()
    {
        return OrderStatus::getStatus($this->status);
    }

    public function getAmount()
    {
        $amount = 0;
        if($this->products) {
            foreach($this->products as $product) {
                $amount += $product->price * $product->pivot->quantity;
            }
        }
        return $amount;
    }

    public function getStripeAmount()
    {
        return $this->getAmount() * 100;
    }

    public function setQuantity($increase)
    {
        $this->load('products');
        foreach ($this->products as $product) {
            if ($increase) {
                $newQuantity = $product->quantity + $product->pivot->quantity;
            } else {
                $newQuantity = $product->quantity - $product->pivot->quantity;
            }
            $product->update(['quantity' => $newQuantity]);
        }
    }
}
