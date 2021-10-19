<?php

namespace App\Policies;

use App\Model\Client\Customer;
use App\User;

class CustomerPolicy
{
    public function edit(User $user, Customer $shop)
    {
        return in_array($shop->id, $user->shops->pluck('id')->toArray());
    }

    public function update(User $user, Customer $shop)
    {
        return in_array($shop->id, $user->shops->pluck('id')->toArray());
    }

    public function delete(User $user, Customer $shop)
    {
        return in_array($shop->id, $user->shops->pluck('id')->toArray());
    }
}