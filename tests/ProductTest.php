<?php

namespace Tests;

class ProductTest extends TestCase
{
    /**
     * /products [GET]
     */
    public function testShouldReturnArrayWithProducts(){
        $this->get('products')
        ->seeStatusCode(200)
        ->seeJsonStructure([
            'sku',
            'name',
            'category',
            'price' => [
                'original',
                'final',
                'discount_percentage',
                'currency'
            ]
        ]);
    }
}