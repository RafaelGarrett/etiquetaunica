<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->get('api/products');

        $response->assertStatus(200);
    }

    /**
     * Test that an valid post can be created.
     */
    public function test_store(): void
    {
        $product = new Product();
        $product->sku = fake()->unique()->bothify('SKU-####');
        $product->name = fake('pt_BR')->name();
        $product->description = fake('pt_BR')->text(255);
        $product->price = fake()->randomFloat(2, 0, 1000);
        $product->category = fake()->word();
        $product->status = 'active';
        $response = $this->post('api/products', $product->toArray());
        $response->assertStatus(201);
    }

}
