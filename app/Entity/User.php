<?php
namespace App\Entity;

use App\Traits\Eloquent\HasActive;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableInterface;

/**
 * Class User
 * @package App\Entity
 */
class User extends Authenticatable implements AuthenticatableInterface
{
    use HasActive, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'is_active',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_admin' => 'boolean',
    ];

    /**
     * Get the full name of the user.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Check if the user is an Administrator.
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Get the cars for the user.
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
