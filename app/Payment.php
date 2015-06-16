<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

	protected $table = 'payments';
    protected $fillable = array('brand', 'exp_month', 'exp_year');

}
