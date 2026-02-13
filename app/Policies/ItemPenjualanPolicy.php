<?php

namespace App\Policies;

use App\models\ItemPenjualan;
use App\Models\User;

class ItemPenjualanPolicy
{ 
    public function delete(User $user, ItemPenjualan $itempenjualan): bool
    {
        return $user->role->name === 'admin';
    }
}
