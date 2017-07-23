<?php
namespace App\Managers\Contracts\Criteria;

/**
 * Interface CriterionInterface
 * @package App\Managers\Contracts\Criteria
 */
interface CriterionInterface
{
    /**
     * Applies the specified criterion to the Entity(ies) selection query.
     *
     * @param  mixed $entity
     * @return mixed
     */
    public function apply($entity);
}
