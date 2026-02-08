<?php

namespace App\Models\User;

use App\Models\User\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerAddresses extends Model
{
    protected $guarded = [];

    protected $table = "customer_addresses";

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
