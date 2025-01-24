<?php

declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductsTable;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

class ProductsTableTest extends TestCase
{
    protected $Products;

    protected array $fixtures = ['app.Products'];

    public function setUp(): void
    {
        parent::setUp();
        $this->Products = TableRegistry::getTableLocator()->get('Products', [
            'connectionName' => 'test'
        ]);
    }

    public function testInvalidName(): void
    {
        $product = $this->Products->newEntity([
            'name' => 'ab',  // Too short
            'quantity' => 50,
            'price' => 19.99,
            'status' => 'in stock'
        ]);

        $this->assertNotEmpty($product->getErrors());
        $this->assertArrayHasKey('name', $product->getErrors());
    }

    public function testInvalidQuantity(): void
    {
        $product = $this->Products->newEntity([
            'name' => 'Valid Product',
            'quantity' => 1001,  // Exceeds maximum
            'price' => 19.99,
            'status' => 'in stock'
        ]);

        $this->assertNotEmpty($product->getErrors());
        $this->assertArrayHasKey('quantity', $product->getErrors());
    }

    public function testInvalidPrice(): void
    {
        $product = $this->Products->newEntity([
            'name' => 'Valid Product',
            'quantity' => 50,
            'price' => 10001,  // Exceeds maximum
            'status' => 'in stock'
        ]);

        $this->assertNotEmpty($product->getErrors());
        $this->assertArrayHasKey('price', $product->getErrors());
    }

    public function testInvalidStatus(): void
    {
        $product = $this->Products->newEntity([
            'name' => 'Valid Product',
            'quantity' => 50,
            'price' => 19.99,
            'status' => 'invalid status'  // Invalid status
        ]);

        $this->assertNotEmpty($product->getErrors());
        $this->assertArrayHasKey('status', $product->getErrors());
    }

    public function testPromoProductPriceRule(): void
    {
        $product = $this->Products->newEntity([
            'name' => 'Promo Product',
            'quantity' => 50,
            'price' => 51,  // Should be less than 50 for promo products
            'status' => 'in stock'
        ]);

        $this->assertNotEmpty($product->getErrors());
        $this->assertArrayHasKey('name', $product->getErrors());
    }
}
