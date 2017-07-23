<?php
namespace App\Managers\Eloquent\Criteria;

use App\Managers\Contracts\Criteria\CriterionInterface;

/**
 * Class Latest
 *
 * Finds last entities by the specific column
 * (the default is the entity creation time).
 *
 * @package App\Managers\Eloquent\Criteria
 */
class Latest implements CriterionInterface
{
    /**
     * @var string
     */
    protected $column = 'created_at';

    /**
     * @param string $column
     */
    public function __construct(string $column)
    {
        $this->column = $column;
    }

    /**
     * @inheritdoc
     */
    public function apply($entity)
    {
        return $entity->latest($this->column);
    }
}
