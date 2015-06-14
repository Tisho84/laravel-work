<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = ['name', 'available_m25', 'other_info'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeIsInM25($query)
    {
        return $query->where('available_m25', true);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeIsNotInM25($query)
    {
        return $query->where('available_m25', false);
    }
}
