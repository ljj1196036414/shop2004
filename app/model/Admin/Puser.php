<?php

namespace App\model\Admin;

use Illuminate\Database\Eloquent\Model;

class Puser extends Model
{
    protected $table="p_users";
    protected $primaryKey="user_id";
    public $timestamps=false;
}
