<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SuppliersTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->invalidSupplierData = [
            'foo' => 'bar'
        ];

        $this->validSupplierData = raw('App\Supplier');

        $this->supplier = create('App\Supplier');
    }

    // create supplier test case's

    /** @test */

    public function cannot_create_supplier_with_invalid_data()
    {
        $this->signIn();

        $this->post(route('supplier.store'), $this->invalidSupplierData)
            ->assertStatus(302)
            ->assertSessionHasErrors();
    }

    /** @test */

    public function unauthenticated_user_cannot_create_supplier()
    {
        $this->post(route('supplier.store'), $this->validSupplierData)
            ->assertStatus(302)
            ->assertRedirect(route('login'));

    }

    /** @test */

    public function authenticated_user_can_create_supplier_with_valid_data()
    {
        $this->signIn();

        $this->post(route('supplier.store'), $this->validSupplierData)
            ->assertStatus(302)
            ->assertSessionHas('success')
            ->assertRedirect(route('suppliers'));

        $this->assertDatabaseHas('suppliers',$this->validSupplierData);
    }

    // update supplier test case's

    /** @test */

    public function cannot_update_supplier_with_invalid_data()
    {
        $this->signIn();

        $this->post(route('supplier.update',$this->supplier), $this->invalidSupplierData)

            ->assertStatus(302)

            ->assertSessionHasErrors();
    }

    /** @test */

    public function unauthenticated_user_cannot_update_supplier()
    {
        $this->post(route('supplier.update',$this->supplier),$this->validSupplierData)

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_update_supplier_with_valid_data()
    {
        $this->signIn();

        $newSupplier = raw('App\Supplier',[
            'name' => 'supplier update'
        ]);

        $this->post(route('supplier.update',$this->supplier),$newSupplier)

            ->assertRedirect(route('suppliers'))

            ->assertSessionHas('success')

            ->assertStatus(302);

        $this->assertDatabaseHas('suppliers',$newSupplier);
    }

    // delete supplier test case's

    /** @test */

    public function unauthenticated_user_cannot_delete_supplier()
    {
        $this->delete(route('supplier.destroy',$this->supplier))

            ->assertStatus(302)

            ->assertRedirect(route('login'));
    }

    /** @test */

    public function authenticated_user_can_delete_supplier()
    {
        $this->signIn();

        $this->delete(route('supplier.destroy',$this->supplier))

            ->assertStatus(302)

            ->assertSessionHas('success')

            ->assertRedirect(route('suppliers'));

        $this->assertTrue($this->supplier->fresh()->deleted);
    }
}
