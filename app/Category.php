<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = 'categories';

    protected $fillable = ['name', 'description', 'active'];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
