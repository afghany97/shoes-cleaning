<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->invalidProductData = [
            'foo' => 'bar'
        ];

        $this->validProductData = raw('App\Product');

        $this->product = create('App\Product');
    }

    // create product test case's

    /** @test */

    public function cannot_create_product_with_invalid_data()
    {
        $this->signIn();

        $this->post(route('product.store'),$this->invalidProductData)

            ->assertStatus(302)

            ->assertSessionHasErrors();
    }

    /** @test */

    public function unauthenticated_user_cannot_create_product()
    {
        $this->post(route('product.store'),$this->validProductData)

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_create_product_with_valid_data()
    {
        $this->signIn();

        $this->post(route('product.store'),$this->validProductData)

            ->assertStatus(302)

            ->assertRedirect(route('products'))

            ->assertSessionHas('success');
    }

    // update product test case's

    /** @test */

    public function cannot_update_product_with_invalid_data()
    {
        $this->signIn();

        $this->post(route('product.update',$this->product),$this->invalidProductData)

            ->assertStatus(302)

            ->assertSessionHasErrors();
    }

    /** @test */

    public function unauthenticated_user_cannot_update_product()
    {
        $this->post(route('product.update',$this->product),$this->validProductData)

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_update_product_with_valid_data()
    {
        $this->signIn();

        $updateProduct = raw('App\Product',[
            'description' => 'product updated dude'
        ]);

        $this->post(route('product.update',$this->product),$updateProduct)

            ->assertStatus(302)

            ->assertSessionHas('success');
    }

    // delete product test case's

    /** @test */

    public function unauthenticated_user_cannot_delete_product()
    {
        $this->delete(route('product.destroy',$this->product))

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_delete_product()
    {
        $this->signIn();

        $this->delete(route('product.destroy',$this->product))

            ->assertStatus(302)

            ->assertSessionHas('success')

            ->assertRedirect(route('products'));

        $this->assertTrue($this->product->fresh()->deleted);
    }
}
