<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'price',
        'category',
        'status' => 'active',
    ];

    public function scopeSearch($query, $request)
    {

        $terms = $request->only('name', 'description');

        foreach ($terms as $name => $value) {
            if ($value) { 
                $query->where($name, 'LIKE', '%' . $value . '%');
            }
        }

        return $query;
    }
}
