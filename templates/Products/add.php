<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="products form content">
            <?= $this->Form->create($product) ?>
            <fieldset>
                <legend><?= __('Add Product') ?></legend>
                <?php
                echo $this->Form->control('name', ['required' => true, 'maxlength' => 50]);
                echo $this->Form->control('description', ['type' => 'textarea']);
                echo $this->Form->control('quantity', ['type' => 'number', 'min' => 0, 'max' => 1000]);
                echo $this->Form->control('price', ['type' => 'number', 'step' => '0.01', 'min' => 0.01, 'max' => 10000]);
                echo $this->Form->control('status', [
                    'options' => [
                        'in stock' => 'In Stock',
                        'low stock' => 'Low Stock',
                        'out of stock' => 'Out of Stock'
                    ]
                ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>