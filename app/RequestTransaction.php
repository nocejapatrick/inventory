<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestTransaction extends Model
{
    //
    protected $fillable = ['user_id'];

    function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    function request(){
        return $this->hasMany('App\Request','request_transaction_id')->with('item');
    }
}
