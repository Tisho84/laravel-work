<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

	protected $table = 'payments';

    protected $fillable = array('brand', 'exp_month', 'exp_year');

    public function type()
    {
        return $this->belongsTo('App\PaymentType');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}
