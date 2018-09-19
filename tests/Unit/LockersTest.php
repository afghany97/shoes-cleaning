<?php

namespace Tests\Unit;

use App\Locker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LockersTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->validLockersData = [
            'start' => 1,
            'end' => 10,
            'type' => array_rand(config('locker.type'),1)
        ];

        $this->invalidLockersData = [];

        $this->order = create('App\Order');

        $this->locker = create('App\Locker');
    }

    // create locker test case's

    /** @test */

    public function unauthenticated_user_cannot_create_lockers()
    {
        $this->post(route('locker.store'),$this->validLockersData)

            ->assertRedirect(route('login'))

            ->assertStatus(302);
    }

    /** @test */

    public function cannot_create_lockers_with_invalid_data()
    {
        $this->post(route('locker.store'),$this->invalidLockersData)

            ->assertStatus(302)

            ->assertRedirect(route('login'));

        $this->signIn();

        $this->post(route('locker.store'),$this->invalidLockersData)

            ->assertStatus(302)

            ->assertSessionHasErrors();
    }

    /** @test */

    public function can_create_lockers_with_valid_data()
    {
        $this->signIn();

        $oldLockersCount = Locker::count();

        $this->post(route('locker.store'),$this->validLockersData)

            ->assertRedirect()

            ->assertSessionHas('success')

            ->assertStatus(302);

        $createdAmount = ($this->validLockersData['end'] - $this->validLockersData['start']) + 1;

        $this->assertEquals($oldLockersCount + $createdAmount , Locker::count());
    }

    // delete locker test case's

    /** @test */

    public function unauthenticated_user_cannot_delete_locker()
    {
        $this->delete(route('locker.destroy',$this->locker))

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_delete_locker()
    {
        $this->signIn();

        $this->delete(route('locker.destroy',$this->locker))

            ->assertRedirect(route('lockers'))

            ->assertStatus(302)

            ->assertSessionHas('success');

        $this->assertTrue($this->locker->fresh()->deleted);
    }
}
