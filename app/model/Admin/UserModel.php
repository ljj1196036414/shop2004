<?php

namespace App\model\Admin;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table='user';
    protected $primaryKey='uid';
    public $timestamps=false;
}
