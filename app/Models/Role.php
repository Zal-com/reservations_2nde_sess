<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use CrudTrait;


    protected $fillable = ['name', 'guard_name', 'updated_at', 'created_at'];

    protected $table = 'roles';

    public $timestamps = false;
}
