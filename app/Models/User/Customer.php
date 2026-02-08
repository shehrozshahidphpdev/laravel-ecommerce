<?php

namespace App\Models\User;

use App\Models\User\CustomerAddresses;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Customer as Authenticatable;

class Customer extends Authenticatable
{
    protected $guarded = [];

    protected $table = 'customers';

    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddresses::class, 'customer_id');
    }
}
