<?php

declare(strict_types=1);

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\Event\Event;

class SoftDeleteBehavior extends Behavior
{
    public function beforeFind(Event $event, Query $query, $options)
    {
        $query->where([$this->_table->aliasField('deleted') => false]);
    }

    public function softDelete($entity)
    {
        $entity->deleted = true;
        return $this->_table->save($entity);
    }
}
