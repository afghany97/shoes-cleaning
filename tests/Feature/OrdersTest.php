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

    // order page test case's

    /** @test */

    public function unauthenticated_user_cannot_visit_order_page()
    {
        $this->get(route('order.show',$this->order))

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_visit_order_page()
    {
        $this->signIn();

        $this->get(route('order.show',$this->order))

            ->assertStatus(200)

            ->assertSee($this->order->barcode)

            ->assertSee($this->order->status)

            ->assertSee($this->order->customer->name)

            ->assertSee($this->order->customer->mobile)

            ->assertSee($this->order->customer->address)

            ->assertSee($this->order->shoes->type)

            ->assertSee($this->order->note)

            ->assertSee($this->order->price)

            ->assertSee($this->order->delivery_date);
    }

    // orders filter test cases

    /** @test */

    public function authenticated_user_can_filter_orders_by_status()
    {
        $this->signIn();

        $completedOrder = create('App\Order',['status' => config('order.status.completed')]);

        $progressOrder = create('App\Order',['status' => config('order.status.progress')]);

        $this->get(route('orders') . "?status=completed")

            ->assertStatus(200)

            ->assertSee($completedOrder->customer->name)

            ->assertSee($completedOrder->barcode)

            ->assertDontSee($progressOrder->barcode)

            ->assertDontSee($progressOrder->customer->name);

        $this->get(route('orders') . "?status=progress")

            ->assertStatus(200)

            ->assertDontSee($completedOrder->customer->name)

            ->assertDontSee($completedOrder->barcode)

            ->assertSee($progressOrder->barcode)

            ->assertSee($progressOrder->customer->name);
    }

    /** @test */

    public function authenticated_user_can_filter_orders_by_customer_mobile()
    {
        $this->signIn();

        $customer = create('App\Customer',['mobile' => '12345678910']);

        $order = create('App\Order',['customer_id' => $customer->id]);

        $this->get(route('orders') . "?mobile=12345678910")

            ->assertStatus(200)

            ->assertSee($order->customer->name)

            ->assertSee($order->barcode)

            ->assertDontSee($this->order->barcode)

            ->assertDontSee($this->order->customer->name);
    }

    /** @test */

    public function authenticated_user_can_filter_orders_by_customer_name()
    {
        $this->signIn();

        $customer = create('App\Customer',['name' => 'afghany']);

        $order = create('App\Order',['customer_id' => $customer->id]);

        $this->get(route('orders') . "?name=afghany")

            ->assertStatus(200)

            ->assertSee($order->customer->name)

            ->assertSee($order->barcode)

            ->assertDontSee($this->order->barcode)

            ->assertDontSee($this->order->customer->name);
    }

    /** @test */

    public function authenticated_user_can_filter_orders_by_shoe_type()
    {
        $this->signIn();

        $shoe = create('App\Shoes',['type' => 'addidas']);

        $order = create('App\Order',['shoes_id' => $shoe->id]);

        $this->get(route('orders') . "?shoe=addidas")

            ->assertStatus(200)

            ->assertSee($order->barcode)

            ->assertDontSee($this->order->barcode);
    }
}
