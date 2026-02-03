<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Customer as Authenticatable;

class Customer extends Authenticatable
{
    protected $guarded = [];
}
