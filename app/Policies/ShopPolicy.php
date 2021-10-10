<?php

namespace App\Policies;

use App\Model\Client\Shop;
use App\User;

class ShopPolicy
{
    public function edit(User $user, Shop $shop)
    {
        return $user->id === $shop->user_id;
    }

    public function update(User $user, Shop $shop)
    {
        return $user->id === $shop->user_id;
    }

    public function delete(User $user, Shop $shop)
    {
        return $user->id === $shop->user_id;
    }
}