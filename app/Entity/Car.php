<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'color',
        'model',
        'registration_number',
        'year',
        'mileage',
        'price',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}