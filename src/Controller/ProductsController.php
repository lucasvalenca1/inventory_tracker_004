<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        // Allow public access to index and view actions

    }

    public function index()
    {
        // Base query excluding soft-deleted items
        $query = $this->Products->find()
            ->where(['deleted' => false]);

        // Search filter
        if ($this->request->getQuery('search')) {
            $query->where(['name LIKE' => '%' . $this->request->getQuery('search') . '%']);
        }

        // Status filter
        if ($this->request->getQuery('status')) {
            $status = $this->request->getQuery('status');
            $query->where(['status' => $status]);
        }

        // Paginate results
        $products = $this->paginate($query, [
            'limit' => 10,
            'order' => ['last_updated' => 'DESC']
        ]);

        $this->set(compact('products'));
    }

    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'conditions' => ['deleted' => false]
        ]);
        $this->set(compact('product'));
    }

    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['deleted'] = 0; // Set deleted to 0 by default
            $product = $this->Products->patchEntity($product, $data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }


    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'conditions' => ['deleted' => false]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);

        // Soft delete implementation
        if ($this->Products->softDelete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
