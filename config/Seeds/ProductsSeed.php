<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

class ProductsSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Basic T-Shirt',
                'quantity' => 100,
                'price' => 19.99,
                'status' => 'in stock',
                'deleted' => false,
            ],
            [
                'name' => 'Premium Jeans',
                'quantity' => 50,
                'price' => 79.99,
                'status' => 'in stock',
                'deleted' => false,
            ],
            [
                'name' => 'Summer Dress',
                'quantity' => 30,
                'price' => 49.99,
                'status' => 'in stock',
                'deleted' => false,
            ],
            [
                'name' => 'Winter Coat',
                'quantity' => 20,
                'price' => 129.99,
                'status' => 'in stock',
                'deleted' => false,
            ],
            [
                'name' => 'Running Shoes',
                'quantity' => 40,
                'price' => 89.99,
                'status' => 'in stock',
                'deleted' => false,
            ],
            [
                'name' => 'Leather Wallet',
                'quantity' => 15,
                'price' => 39.99,
                'status' => 'low stock',
                'deleted' => false,
            ],
            [
                'name' => 'Sunglasses',
                'quantity' => 5,
                'price' => 29.99,
                'status' => 'low stock',
                'deleted' => false,
            ],
            [
                'name' => 'Promo Socks Pack',
                'quantity' => 200,
                'price' => 9.99,
                'status' => 'in stock',
                'deleted' => false,
            ],
            [
                'name' => 'Limited Edition Watch',
                'quantity' => 0,
                'price' => 199.99,
                'status' => 'out of stock',
                'deleted' => false,
            ],
            [
                'name' => 'Casual Shirt',
                'quantity' => 75,
                'price' => 34.99,
                'status' => 'in stock',
                'deleted' => false,
            ],
        ];

        $table = $this->table('products');
        $table->insert($data)->save();
    }
}
