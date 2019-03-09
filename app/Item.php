<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = ['item_id','item_name','item_stock','item_classification','item_skill','item_unit','item_threshold'];
}
