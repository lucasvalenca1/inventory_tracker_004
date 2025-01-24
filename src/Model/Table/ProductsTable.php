<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class ProductsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->setEntityClass('App\Model\Entity\Product');

        $this->addBehavior('App\Model\Behavior\SoftDeleteBehavior');
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'last_updated' => 'always'
                ]
            ]
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name', 'Name is required')
            ->minLength('name', 3, 'Name must be at least 3 characters long')
            ->maxLength('name', 50, 'Name must not exceed 50 characters')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity', 'Quantity is required')
            ->greaterThanOrEqual('quantity', 0, 'Quantity must be 0 or greater')
            ->lessThanOrEqual('quantity', 1000, 'Quantity must not exceed 1000');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price', 'Price is required')
            ->greaterThan('price', 0, 'Price must be greater than 0')
            ->lessThanOrEqual('price', 10000, 'Price must not exceed 10,000');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status', 'Status is required')
            ->inList('status', ['in stock', 'low stock', 'out of stock'], 'Invalid status');

        $validator
            ->add('price', 'custom', [
                'rule' => function ($value, $context) {
                    if ($value > 100 && $context['data']['quantity'] < 10) {
                        return false;
                    }
                    return true;
                },
                'message' => 'Products with a price over 100 must have a minimum quantity of 10'
            ]);

        $validator
            ->add('name', 'promo_price', [
                'rule' => function ($value, $context) {
                    if (stripos($value, 'promo') !== false && $context['data']['price'] >= 50) {
                        return false;
                    }
                    return true;
                },
                'message' => 'Products with "promo" in the name must have a price less than 50'
            ]);

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['name']), ['errorField' => 'name']);

        return $rules;
    }
}
