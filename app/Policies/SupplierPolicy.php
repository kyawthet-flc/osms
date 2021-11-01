<?php

namespace App\Policies;

use App\Model\Client\Supplier;
use App\User;

class SupplierPolicy
{
    public function edit(User $user, Supplier $supplier)
    {
        return $user->id === $supplier->user_id;
    }

    public function update(User $user, Supplier $supplier)
    {
        return $user->id === $supplier->user_id;
    }

    public function delete(User $user, Supplier $supplier)
    {
        return $user->id === $supplier->user_id;
    }
}