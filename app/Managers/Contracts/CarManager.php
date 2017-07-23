<?php
namespace App\Managers\Contracts;

/**
 * Interface CarManager
 * @package App\Repositories\Contracts
 */
interface CarManager
{
    /**
     * Finds all cars that belongs only to active users.
     *
     * @return mixed Collection of cars
     */
    public function findAllFromActiveUsers();
}
