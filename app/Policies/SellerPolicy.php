<?php

declare(strict_types=1);

namespace App\Policies;

use App\Sale;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    public function before($user, $ability)
    {
        if (
      $user->isSuperAdmin() ||
      $user->isAdmin()
    ) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the sale.
     */
    public function view(User $user, Sale $sale)
    {
        return
      $user->isSales() &&
      $sale->user->id === $user->id;
    }

    /**
     * Determine whether the user can create sales.
     */
    public function create(User $user)
    {
        return $user->isSales();
    }

    /**
     * Determine whether the user can update the sale.
     */
    public function update(User $user, Sale $sale)
    {
        return
      $user->isSales() &&
      $sale->user->id === $user->id;
    }

    /**
     * Determine whether the user can delete the sale.
     */
    public function delete(User $user, Sale $sale)
    {
        return
      $user->isSales() &&
      $sale->user->id === $user->id;
    }
}
