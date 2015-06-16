<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressType extends Model {

    protected $table = 'address_types';
    public $timestamps = false;
    protected $fillable = array('name');


}
