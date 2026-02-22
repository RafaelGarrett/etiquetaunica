<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{

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

    public function test_show(): void
    {
        $product = Product::query()->inRandomOrder()->first();
        $response = $this->get("api/products?page=2&name=celular&status=active");
        $response->assertStatus(200);
    }

    public function test_update(): void
    {
        $product = Product::query()->inRandomOrder()->first();
        $product->name = fake('pt_BR')->name();
        $product->description = fake('pt_BR')->text(255);
        $response = $this->put("api/products/{$product->id}", $product->toArray());
        $response->assertStatus(200);
    }

    public function test_destroy(): void
    {
        $product = Product::query()->inRandomOrder()->first();
        $response = $this->delete("api/products/{$product->id}");
        $response->assertStatus(204);
    }

}
