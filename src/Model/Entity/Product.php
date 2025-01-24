<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class representing a Product entity.
 */
class Product extends Entity
{
    protected array $_accessible = [
        'name' => true,
        'quantity' => true,
        'price' => true,
        'last_updated' => true,
        'deleted' => true,
        'created' => true,
    ];

    protected array $_virtual = ['status']; // Explicitly specify the type as array

    /**
     * Derive stock status based on quantity.
     *
     * @return string Stock status ('in stock', 'low stock', 'out of stock')
     */
    protected function _getStatus(): string
    {
        $qty = (int)($this->quantity ?? 0);

        return match (true) {
            $qty > 10 => 'in stock',
            $qty >= 1 => 'low stock',
            default => 'out of stock',
        };
    }
}
