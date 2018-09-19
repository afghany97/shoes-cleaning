<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->validOrderData = raw('App\Order',[],null,'create-order-testing');

        $this->invalidOrderData = [

            'foo' => 'bar'
        ];

        $this->progressLocker = create('App\Locker',['status' => config('locker.status.free') , 'type' => config('locker.type.progress')]);

        $this->cleanLocker  = create('App\Locker',['status' => config('locker.status.free'),'type'=> config('locker.type.completed')]);

        $this->order = create('App\Order',['locker_id' => $this->progressLocker->id]);

        $this->progressLocker->update(['order_id' => $this->order->id]);

    }

    // create order test case's

    /** @test */

    public function cannot_create_order_with_invalid_data()
    {
        $this->signIn();

        $this->post(route('order.store'), $this->invalidOrderData)

            ->assertStatus(302)

            ->assertSessionHasErrors();
    }

    /** @test */

    public function unauthenticated_user_cannot_create_order()
    {
        $this->post(route('order.store'), $this->validOrderData)

            ->assertRedirect(route('login'))

            ->assertStatus(302);
    }

    // complete order test case's

    /** @test */

    public function unauthenticated_user_cannot_complete_order()
    {
        $this->get(route('order.complete',$this->order))

            ->assertRedirect(route('login'))

            ->assertStatus(302);
    }

    /** @test */

    public function authenticated_user_can_complete_order()
    {
        $this->signIn();

        $this->get(route('order.complete',$this->order))

            ->assertStatus(302)

            ->assertSessionHas('success')

            ->assertRedirect(route('order.show',$this->order));

        $this->assertNotEquals($this->order->fresh()->locker_id,$this->progressLocker->id);
    }

    // deliver order test case's

    /** @test */

    public function unauthenticated_user_cannot_deliver_order()
    {
        $this->get(route('order.deliver',$this->order))

            ->assertRedirect(route('login'))

            ->assertStatus(302);
    }

    /** @test */

    public function authenticated_user_can_deliver_order()
    {
        $this->signIn();

        $this->get(route('order.deliver',$this->order))

            ->assertStatus(302)

            ->assertSessionHas('success')

            ->assertRedirect(route('orders'));

        $this->assertNull($this->order->fresh()->locker_id);
    }
}
