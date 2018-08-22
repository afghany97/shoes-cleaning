<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SuppliersTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->supplier = create('App\Supplier');
    }

    // suppliers index page test case's

    /** @test */

    public function unauthenticated_user_cannot_visit_suppliers_index_page()
    {
        $this->get(route('suppliers'))

            ->assertRedirect(route('login'))

            ->assertStatus(302);
    }

    /** @test */

    public function authenticated_user_can_visit_suppliers_index_page()
    {
        $this->signIn();

        $this->get(route('suppliers'))

            ->assertStatus(200)

            ->assertSee($this->supplier->name);
    }

    /** @test */

    public function deleted_suppliers_not_appears_in_index_page()
    {
        $this->signIn();

        $deletedSupplier = create('App\Supplier',['name' => 'deleted supplier']);

        $deletedSupplier->softDelete();

        $this->get(route('suppliers'))

            ->assertStatus(200)

            ->assertSee($this->supplier->name)

            ->assertDontSee($deletedSupplier->name);
    }

    // supplier create page test case's

    /** @test */

    public function unauthenticated_user_cannot_visit_supplier_create_page()
    {
        $this->get(route('supplier.create'))

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_visit_supplier_create_page()
    {
        $this->signIn();

        $this->get(route('supplier.create'))

            ->assertStatus(200);
    }

    // supplier update page test case's

    /** @test */

    public function unauthenticated_user_cannot_visit_supplier_edit_page()
    {
        $this->get(route('supplier.edit',$this->supplier))

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_visit_supplier_edit_page()
    {
        $this->signIn();

        $this->get(route('supplier.edit',$this->supplier))

            ->assertStatus(200)

            ->assertSee($this->supplier->name);
    }

}
