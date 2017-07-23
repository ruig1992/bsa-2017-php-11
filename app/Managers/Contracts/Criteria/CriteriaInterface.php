<?php
namespace App\Managers\Contracts\Criteria;

/**
 * Interface CriteriaInterface
 * @package App\Managers\Contracts\Criteria
 */
interface CriteriaInterface
{
    /**
     * Sets the criterion to the Entity(ies) selection query.
     *
     * @param  mixed $criteria  Enumeration or criteria array
     * @return $this
     */
    public function withCriteria(...$criteria);
}
