<?php
namespace App\Managers\Eloquent;

use App\Entity\User;
use Illuminate\Support\Collection;
use App\Managers\AbstractEntityManager;
use App\Managers\Contracts\UserManager as UserManagerContract;

/**
 * Class UserManager
 * @package App\Managers\Eloquent
 */
class UserManager extends AbstractEntityManager implements UserManagerContract
{
    /**
     * @inheritdoc
     */
    public function entity(): string
    {
        return User::class;
    }

    /**
     * @inheritdoc
     */
    public function findAllForForm(array $columns = []): Collection
    {
        $columns = $columns ?: ['id', 'first_name', 'last_name'];

        return $this->findAll($columns);
    }
}
