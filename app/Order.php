<?php namespace App;

use App\Classes\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model {

    protected $fillable = ['user_id', 'processed_on', 'shipped_on', 'expected_delivery_on', 'delivered_on', 'status', 'address_id'];

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
            $this->amount = $amount;
        }
        return $this->amount;
    }

    public function isAuthorized($canEdit = true) #order belong to user and can be edited (admin can do all)
    {
        $flag = true;
        if (!Auth::user()->is_admin) { #check if user has that order
            $flag = Auth::user()->orders()->find($this->id)->first();
            if ($flag && $canEdit) { #order is editable
                $flag = $this->status == 1 ? true: false;
            }
        }
        return $flag;
    }
}
