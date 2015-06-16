<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

    protected $table = 'addresses';
    protected $fillable = array('street', 'city', 'zip', 'country');


}
