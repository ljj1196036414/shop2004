<?php

namespace App\model\Admin;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table='student';
    protected $primaryKey='s_id';
    public $timestamps=false;
}
