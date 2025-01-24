<?php
// File: templates/Products/index.php

// Page title
$this->assign('title', 'Product Inventory');

// Search form
echo $this->Form->create(null, ['type' => 'get']);
echo $this->Form->control('search', ['value' => $this->request->getQuery('search')]);
echo $this->Form->submit('Search');
echo $this->Form->end();

// Status filter dropdown
echo $this->Form->create(null, ['type' => 'get']);
echo $this->Form->control('status', [
    'options' => [
        'in stock' => 'In Stock',
        'low stock' => 'Low Stock',
        'out of stock' => 'Out of Stock'
    ],
    'empty' => 'All Statuses',
    'value' => $this->request->getQuery('status')
]);
echo $this->Form->submit('Filter');
echo $this->Form->end();

// Products table
if (!empty($products)): ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Status</th>
            <th>Last Updated</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= h($product->name) ?></td>
                <td><?= h($product->quantity) ?></td>
                <td><?= h($product->price) ?></td>
                <td><?= h($product->status) ?></td>
                <td><?= h($product->last_updated) ?></td>
                <td>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $product->id]) ?>
                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $product->id], ['confirm' => 'Are you sure?']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No products found.</p>
<?php endif; ?>

<!-- Pagination -->
<?= $this->Paginator->prev('« Previous') ?>
<?= $this->Paginator->numbers() ?>
<?= $this->Paginator->next('Next »') ?>
