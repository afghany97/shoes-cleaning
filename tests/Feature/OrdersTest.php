<?php

namespace Tests\Feature;

use Carbon\Carbon;
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

            ->assertSee($this->order->shoe->type)

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

        $shoe = create('App\Shoe',['type' => 'addidas']);

        $order = create('App\Order',['shoe_id' => $shoe->id]);

        $this->get(route('orders') . "?shoe=addidas")

            ->assertStatus(200)

            ->assertSee($order->barcode)

            ->assertDontSee($this->order->barcode);
    }

    /** @test */

    public function authenticated_user_can_filter_orders_by_delivery_date()
    {
        $this->signIn();

        $order = create('App\Order',['delivery_date' => "2018-10-18"]);

        $otherOrder = create('App\Order',['delivery_date' => "2018-01-01"]);

        $this->get(route('orders') . "?delivery=2018-10-18")

            ->assertStatus(200)

            ->assertSee($order->barcode)

            ->assertDontSee($otherOrder->barcode);

        $this->get(route('orders') . "?delivery=2018-01-01")

            ->assertStatus(200)

            ->assertSee($otherOrder->barcode)

            ->assertDontSee($order->barcode);
    }

    /** @test */

    public function authenticated_user_can_filter_orders_by_from_to_dates_filter()
    {
        $this->signIn();

        $order = create('App\Order',['created_at' => Carbon::today()->format('Y-m-d')]);

        $otherOrder = create('App\Order',['created_at' => Carbon::today()->addMonths(1)->format('Y-m-d')]);

        $from = Carbon::yesterday()->format('Y-m-d');

        $to = Carbon::tomorrow()->format('Y-m-d');

        $this->get(route('orders') . "?from=$from&to=$to")

            ->assertStatus(200)

            ->assertSee($order->barcode)

            ->assertDontSee($otherOrder->barcode);
    }

    /** @test */

    public function authenticated_user_can_filter_orders_by_sensitive_filter()
    {
        $this->signIn();

        $order = create('App\Order',['sensitive' => true]);

        $otherOrder = create('App\Order',['sensitive' => false]);

        $this->get(route('orders') . "?sensitive=1")

            ->assertStatus(200)

            ->assertSee($order->barcode)

            ->assertDontSee($otherOrder->barcode);
    }
}
