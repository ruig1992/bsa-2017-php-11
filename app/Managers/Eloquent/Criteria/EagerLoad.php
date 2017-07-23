<?php
namespace App\Managers\Eloquent\Criteria;

use App\Managers\Contracts\Criteria\CriterionInterface;

/**
 * Class EagerLoad
 *
 * Sets the relationships that should be eager loaded.
 *
 * @package App\Managers\Eloquent\Criteria
 */
class EagerLoad implements CriterionInterface
{
    /**
     * @var array
     */
    protected $relations = [];

    /**
     * @param array $relations
     */
    public function __construct(array $relations = [])
    {
        $this->relations = $relations;
    }

    /**
     * @inheritdoc
     */
    public function apply($entity)
    {
        return $entity->with($this->relations);
    }
}
