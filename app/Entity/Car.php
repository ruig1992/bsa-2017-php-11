<?php
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Car
 * @package App\Entity
 */
class Car extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model',
        'registration_number',
        'year',
        'color',
        'mileage',
        'price',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
    ];

    /**
     * Get the user that owns the car.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
