<?php
namespace App\Managers\Contracts;

/**
 * Interface UserManager
 * @package App\Repositories\Contracts
 */
interface UserManager
{
    /**
     * Finds all users for form element.
     *
     * @param  array $columns
     * @return mixed Collection of users
     */
    public function findAllForForm(array $columns = []);
}
