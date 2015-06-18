<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

	protected $table = 'payments';

    protected $fillable = ['brand', 'exp_month', 'exp_year', 'paid_on'];
    
    protected $hidden = ['last4'];
    
    protected $guarded = ['last4'];
    
    protected $dates = ['paid_on'];

    public function type()
    {
        return $this->belongsTo('App\PaymentType');
    }

    public function order()
    {
        //return $this->belongsTo('App\Order');
        return $this->hasOne('App\Order');
    }
}
