<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //khai bao ten bang
    protected $table = 'vp_categories';
    //
    protected $primaryKey = 'cate_id';
    protected $guarded = []; //co the tuong tac duoc tat ca truong du lieu
}
