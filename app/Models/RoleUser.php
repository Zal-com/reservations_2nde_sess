<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use CrudTrait;

    protected $fillable = [
        'role_id',
        'user_id'
    ];

    protected $table = 'role_users';

    public $timestamps = false;

}
