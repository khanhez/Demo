<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
     protected $table = 'vp_comment';
    //
    protected $primaryKey = 'com_id';
    protected $guarded = []; //co the tuong tac duoc tat ca truong du lieu
}