<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    //
    protected $fillable = ['request_transaction_id','item_id','request_qty','request_status'];

    function item(){
        return $this->hasOne('App\Item','item_id','item_id');
    }
}
