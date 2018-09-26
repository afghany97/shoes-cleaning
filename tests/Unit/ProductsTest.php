<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    /** @test */

    public function authenticated_user_can_creaet_product_with_images()
    {
        $this->signIn();

        $images = [
            UploadedFile::fake()->image(str_random(10) . "jpg"),
            UploadedFile::fake()->image(str_random(10) . "jpg"),
            UploadedFile::fake()->image(str_random(10) . "jpg"),
        ];

        Storage::fake("public");

        $this->post(route('product.store'),array_merge($this->validProductData,['images' => $images]))

            ->assertStatus(302)

            ->assertRedirect(route('products'))

            ->assertSessionHas('success');

        foreach ($images as $image){

            Storage::disk("public")->assertExists("images/products/" . $image->hashName());
        }
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
