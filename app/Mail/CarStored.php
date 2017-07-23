<?php
namespace App\Mail;

use App\Entity\Car;
use App\Entity\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CarStored
 * @package App\Mail
 */
class CarStored extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Entity\User
     */
    protected $user;
    /**
     * @var \App\Entity\Car
     */
    protected $car;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Car $car)
    {
        $this->user = $user;
        $this->car = $car;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->markdown('emails.cars.stored')
            ->with([
                'user' => $this->user->full_name,
                'car' => $this->car->toArray(),
            ]);
    }
}
