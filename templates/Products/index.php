<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
?>
<div class="products index content">
    <h1><?= __('Product Inventory') ?></h1>

    <!-- Add Product Button -->
    <div class="button-container">
        <?= $this->Html->link(__('Add Product'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    </div>

    <!-- Search Box -->
    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <div class="search">
        <?= $this->Form->control('search', [
            'label' => false,
            'placeholder' => 'Search products...',
            'value' => $this->request->getQuery('search')
        ]) ?>
        <?= $this->Form->submit('Search') ?>
    </div>
    <?= $this->Form->end() ?>

    <!-- Status Filters -->
    <div class="filters">
        <?= $this->Html->link('All', ['action' => 'index']) ?>
        <?= $this->Html->link('In Stock', ['action' => 'index', '?' => ['status' => 'in stock']]) ?>
        <?= $this->Html->link('Low Stock', ['action' => 'index', '?' => ['status' => 'low stock']]) ?>
        <?= $this->Html->link('Out of Stock', ['action' => 'index', '?' => ['status' => 'out of stock']]) ?>
    </div>

    <!-- Product Table -->
    <table>
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('quantity') ?></th>
                <th><?= $this->Paginator->sort('price') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('last_updated') ?></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= h($product->name) ?></td>
                    <td><?= $this->Number->format($product->quantity) ?></td>
                    <td><?= $this->Number->currency($product->price) ?></td>
                    <td><?= h($product->status) ?></td>
                    <td><?= h($product->last_updated->format('Y-m-d H:i')) ?></td>
                    <td>
                        <?= $this->Html->link('Edit', ['action' => 'edit', $product->id]) ?>
                        <?= $this->Form->postLink(
                            'Delete',
                            ['action' => 'delete', $product->id],
                            ['confirm' => 'Are you sure?']
                        ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('First')) ?>
            <?= $this->Paginator->prev('< ' . __('Previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Next') . ' >') ?>
            <?= $this->Paginator->last(__('Last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>