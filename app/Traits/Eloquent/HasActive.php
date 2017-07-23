<?php
namespace App\Traits\Eloquent;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasActive
 * @package App\Traits\Eloquent
 */
trait HasActive
{
    /**
     * Scope a query to only include active entities.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('is_active', true);
    }
}
