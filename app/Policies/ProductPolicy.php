<?php

namespace App\Policies;

use App\Model\Client\{Product, Shop};
use App\User;

class ProductPolicy
{
    public function edit(User $user, Product $product)
    { 
        return ($product->shop_id === $product->shop_id && $product->shop->user_id === $user->id);
    }

    public function update(User $user, Product $product)
    {
        return ($product->shop_id === $product->shop_id && $product->shop->user_id === $user->id);
    }

    public function delete(User $user, Product $product)
    {
         return ($product->shop_id === $product->shop_id && $product->shop->user_id === $user->id);
    }
}