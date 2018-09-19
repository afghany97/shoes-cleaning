<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LockersTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->locker = create('App\Locker');
    }

    // lockers page test case's

    /** @test */

    public function unauthenticated_user_cannot_visit_lockers_page()
    {
        $this->get(route('lockers'))

            ->assertRedirect(route('login'))

            ->assertStatus(302);
    }

    /** @test */

    public function authenticated_user_can_visit_lockers_page()
    {
        $this->signIn();

        $this->get(route('lockers'))

            ->assertStatus(200)

            ->assertSee($this->locker->number)

            ->assertSee($this->locker->type)

            ->assertSee($this->locker->status);
    }

    /** @test */

    public function deleted_lockers_not_appears_in_lockers_page()
    {
        $this->signIn();

        $otherLocker = create('App\Locker');

        $this->get(route('lockers'))

            ->assertStatus(200)

            ->assertSee($otherLocker->id)

            ->assertSee($this->locker->id);

        $otherLocker->softDelete();

        $this->get(route('lockers'))

            ->assertStatus(200)

            ->assertSee($this->locker->id)

            ->assertDontSeeText($otherLocker->id);

    }
    // create lockers page test case's

    /** @test */

    public function unauthenticated_user_cannot_visit_create_locker_page()
    {
        $this->get(route('locker.create'))

            ->assertRedirect(route('login'))

            ->assertStatus(302);
    }

    /** @test */

    public function authenticated_user_can_visit_create_locker_page()
    {
        $this->signIn();

        $this->get(route('locker.create'))

            ->assertStatus(200);
    }
}
