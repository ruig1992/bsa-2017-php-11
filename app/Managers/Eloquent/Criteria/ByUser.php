<?php
namespace App\Managers\Eloquent\Criteria;

use App\Managers\Contracts\Criteria\CriterionInterface;

/**
 * Class ByUser
 *
 * Finds entity(ies) that belong to the specific user (by his id).
 *
 * @package App\Managers\Eloquent\Criteria
 */
class ByUser implements CriterionInterface
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @inheritdoc
     */
    public function apply($entity)
    {
        return $entity->where('user_id', $this->userId);
    }
}
