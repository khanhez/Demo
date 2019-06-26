<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'vp_products';
    //
    protected $primaryKey = 'prod_id';
    protected $guarded = []; //co the tuong tac duoc tat ca truong du lieu
}
