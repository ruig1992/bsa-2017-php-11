<?php

use App\Entity\User;
use App\Jobs\SendNotificationEmail;
use Illuminate\Support\Facades\Queue;

class QueueTest extends \Tests\TestCase
{
    public function testSendNotificationEmail()
    {
        Queue::fake();

        $user = new User();
        $user->fill([
            'id' => 1,
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com'
        ]);

        $job = (new SendNotificationEmail($user))->onQueue('notification');
        dispatch($job);


        Queue::assertPushed(SendNotificationEmail::class, function ($job) use ($user) {
            return $job->user->id === $user->id;
        });

        // Assert a job was pushed to a given queue...
        Queue::assertPushedOn('notification', SendNotificationEmail::class);

    }
}
