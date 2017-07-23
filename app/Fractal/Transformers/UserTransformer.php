<?php
namespace App\Fractal\Transformers;

use App\Entity\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 * @package App\Fractal\Transformers
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * Fractal transform the Car data.
     *
     * @param \App\Entity\User $user
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->full_name,
            'email' => $user->email,
        ];
    }
}
