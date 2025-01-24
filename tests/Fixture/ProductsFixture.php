<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductsFixture
 */
class ProductsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'quantity' => 1,
                'price' => 1.5,
                'deleted' => 1,
                'last_updated' => '2025-01-21 15:12:16',
                'created' => '2025-01-21 15:12:16',
            ],
        ];
        parent::init();
    }
}
