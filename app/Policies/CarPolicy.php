<?php
namespace App\Policies;

use App\Entity\Car;
use App\Entity\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CarPolicy
 * @package App\Policies
 */
class CarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the car.
     *
     * @param \App\Entity\User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $this->isAdminUser($user);
    }

    /**
     * Determine whether the user can create cars.
     *
     * @param \App\Entity\User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $this->isAdminUser($user);
    }

    /**
     * Determine whether the user can update the car.
     *
     * @param \App\Entity\User $user
     * @param \App\Entity\Car|null $car
     *
     * @return bool
     */
    public function update(User $user, Car $car = null): bool
    {
        return $this->isAdminUser($user);
    }

    /**
     * Determine whether the user can delete the car.
     *
     * @param \App\Entity\User $user
     * @param \App\Entity\Car|null $car
     *
     * @return bool
     */
    public function delete(User $user, Car $car = null): bool
    {
        return $this->isAdminUser($user);
    }

    /**
     * Determine whether the user is an administrator.
     *
     * @param \App\Entity\User $user
     * @return bool
     */
    private function isAdminUser(User $user): bool
    {
        return $user->isAdmin();
    }
}
