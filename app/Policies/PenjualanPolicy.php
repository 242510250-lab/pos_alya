<?php

namespace App\Policies;

use App\models\Penjualan;
use App\Models\User;

class PenjualanPolicy
{
    /**
     * Create a new policy instance.
     */
    public function delete(User $user, Penjualan $Penjualan): bool
    {
        return $user->role->name === 'admin'
        && $Penjualan->status === 'OPEN';
    }

    Public function view(User $user, Penjualan $Penjualan): bool
    {
        return $user->role->name === 'admin'
        && $Penjualan->status === 'OPEN';
    }
}
