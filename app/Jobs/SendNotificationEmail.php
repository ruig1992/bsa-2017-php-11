<?php
namespace App\Jobs;

use App\Entity\Car;
use App\Entity\User;
use App\Mail\CarStored;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Managers\Contracts\UserManager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\{SerializesModels, InteractsWithQueue};

/**
 * Class SendNotificationEmail
 * @package App\Jobs
 */
class SendNotificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Entity\User
     */
    protected $user;
    /**
     * @var \App\Entity\Car
     */
    protected $car;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user = null, Car $car = null)
    {
        $this->user = $user;
        $this->car = $car;
    }

    /**
     * PHP Magic Get.
     *
     * @param  string $property
     * @return mixed
     */
    public function __get(string $property)
    {
        // Get the user
        if ($property === 'user') {
            return $this->user;
        }
        return null;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserManager $usersManager): void
    {
        $users = $usersManager->findAll(['first_name', 'last_name', 'email']);

        foreach ($users as $user) {
            Mail::to($user->email)->send(new CarStored($user, $this->car));
        }
    }
}
