<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = ['user_id', 'service_id', 'amount'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo('App\Service');
    }
}
