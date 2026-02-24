<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Validator;

class ProductTest extends TestCase
{

    public function test_name_required(): void
    {
        
        $request = new StoreProductRequest();
        $rules = $request->rules();
        
        $data = [
            'sku' => '',
            'name' => '', 
            'description' => 123, 
            'price' => -1, 
            'category' => 456, 
            'status' => ''
        ];
        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('name', $validator->errors()->toArray());
        $this->assertArrayHasKey('sku', $validator->errors()->toArray());
        $this->assertArrayHasKey('description', $validator->errors()->toArray());
        $this->assertArrayHasKey('price', $validator->errors()->toArray());
        $this->assertArrayHasKey('category', $validator->errors()->toArray());
        $this->assertArrayHasKey('status', $validator->errors()->toArray());
    }

}
