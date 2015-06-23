<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    public static $rules = [
        'id' => [
            'type_id' => 'required|exists:payment_types,id'
        ],
        'info' => [ //todo check if card is expired before final payment
            'brand' => 'required|max:255',
            'exp_year' => 'required|size:4',
            'exp_month' => 'required|digits_between:0,12',
            'last4' => 'required|size:4',
        ]
    ];

	protected $table = 'payments';

    protected $fillable = ['brand', 'exp_month', 'exp_year', 'paid_on', 'type_id', 'last4'];

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
