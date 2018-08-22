<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->product = create('App\Product');
    }

    // products index page test case's

    /** @test */

    public function unauthenticated_user_cannot_visit_products_index_page()
    {
        $this->get(route('products'))

            ->assertRedirect(route('login'))

            ->assertStatus(302);
    }

    /** @test */

    public function authenticated_user_can_visit_products_index_page()
    {
        $this->signIn();

        $this->get(route('products'))

            ->assertStatus(200)

            ->assertSee($this->product->description);
    }

    /** @test */

    public function deleted_products_not_appears_in_index_page()
    {
        $this->signIn();

        $deletedProduct = create('App\Product',['description' => 'deleted product']);

        $deletedProduct->softDelete();

        $this->get(route('products'))

            ->assertStatus(200)

            ->assertSee($this->product->description)

            ->assertDontSee($deletedProduct->description);
    }

    // product create page test case's

    /** @test */

    public function unauthenticated_user_cannot_visit_product_create_page()
    {
        $this->get(route('product.create'))

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_visit_product_create_page()
    {
        $this->signIn();

        $this->get(route('product.create'))

            ->assertStatus(200);
    }

    // product update page test case's

    /** @test */

    public function unauthenticated_user_cannot_visit_product_edit_page()
    {
        $this->get(route('product.edit',$this->product))

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_visit_product_edit_page()
    {
        $this->signIn();

        $this->get(route('product.edit',$this->product))

            ->assertStatus(200)

            ->assertSee($this->product->description);
    }
}

