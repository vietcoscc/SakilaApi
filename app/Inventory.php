<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $primaryKey = 'inventory_id';
    protected $table = 'inventory';
    public $timestamps = false;

    
}
