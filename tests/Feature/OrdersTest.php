<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();

        $this->order = create('App\Order');
    }

    // orders page test case's

    /** @test */

    public function unauthenticated_user_cannot_visit_orders_page()
    {
        $this->get(route('orders'))

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_visit_orders_page()
    {
        $this->signIn();

        $this->get(route('orders'))

            ->assertStatus(200)

            ->assertSee($this->order->barcode);
    }

    // create order page test case's

    /** @test */

    public function unauthenticated_user_cannot_visit_create_order_page()
    {
        $this->get(route('order.create'))

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_visit_create_order_page()
    {
        $this->signIn();

        $this->get(route('order.create'))

            ->assertStatus(200);
    }

    // order information page test case's

    /** @test */

    public function unauthenticated_user_cannot_visit_specific_order_page()
    {
        $this->get(route('order.show',$this->order))

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_visit_specific_order_page()
    {
        $this->signIn();

        $this->get(route('order.show',$this->order))

            ->assertStatus(200)

            ->assertSee($this->order->barcode)

            ->assertSee($this->order->customer->mobile);
    }
}
