<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{


    protected $fillable = ['name', 'guard_name', 'updated_at', 'created_at'];

    protected $table = 'roles';

    public $timestamps = false;
}
