<?php

namespace App\Policies;

use App\Model\Client\Customer;
use App\User;

class CustomerPolicy
{
    public function edit(User $user, Customer $customer)
    {
        return in_array($customer->shop_id, $user->shops->pluck('id')->toArray());
    }

    public function update(User $user, Customer $customer)
    {
        return in_array($customer->shop_id, $user->shops->pluck('id')->toArray());
    }

    public function delete(User $user, Customer $customer)
    {
        return in_array($customer->shop_id, $user->shops->pluck('id')->toArray());
    }
}