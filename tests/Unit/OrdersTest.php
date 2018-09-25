<?php

namespace Tests\Unit;

use App\Locker;
use App\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->validOrderData = [
            'mobile' => 12345678910,
            'name' => 'afghany',
            'address' => 'cairo',
            'price' => 150,
            'shoes_id' => 1,
            'priority' => config('order.priority.default')
        ];

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

    /** @test */

    public function authenticated_user_can_create_order_with_required_data()
    {
        $this->signIn();

        $oldCount = Order::count();

        $this->post(route('order.store'),$this->validOrderData)

            ->assertStatus(302)

            ->assertSessionHas('success');

        $this->assertEquals($oldCount  + 1,Order::count());
    }

    /** @test */

    public function authenticated_user_can_create_order_with_delivery_date()
    {
        $this->signIn();

        $this->post(route('order.store'),array_merge($this->validOrderData,['delivery_date' => $date = Carbon::today()->addDays(5)->format("Y-m-d")]))

            ->assertStatus(302)

            ->assertSessionHas('success');

//        $this->assertSame($date,Order::latest()->first()->delivery_date); // passes times and fails times !!

        $this->assertDatabaseHas('orders',['delivery_date' => $date]);

        $this->assertEquals(1,Order::where('delivery_date',$date)->count());
    }

    /** @test */

    public function authenticated_user_can_create_order_with_out_free_lockers()
    {
        Locker::truncate();

        $this->signIn();

        $this->post(route('order.store'),$this->validOrderData)

            ->assertStatus(302)

            ->assertSessionHas('success');

        $this->assertNull(Order::latest()->first()->locker_id);
    }

    /** @test */

    public function authenticated_user_can_create_order_with_images()
    {
        $this->signIn();

        Storage::fake("public");

        $images = [
            UploadedFile::fake()->image(str_random(10) . "jpg"),
            UploadedFile::fake()->image(str_random(10) . "jpg"),
            UploadedFile::fake()->image(str_random(10) . "jpg"),
        ];

        $this->post(route('order.store'),array_merge($this->validOrderData,['images' => $images]))

            ->assertStatus(302)

            ->assertSessionHas('success');

        foreach ($images as $image){

            Storage::disk("public")->assertExists('images/orders/' . $image->hashName());
        }
    }

    /** @test */

    public function authenticated_user_can_create_order_with_note()
    {
        $this->signIn();

        $this->post(route('order.store'),array_merge($this->validOrderData,['note' => $note = str_random()]))

            ->assertStatus(302)

            ->assertSessionHas('success');

        $this->assertDatabaseHas('orders',['note' => $note]);
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
