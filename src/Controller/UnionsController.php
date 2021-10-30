<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Unions Controller
 *
 * @property \App\Model\Table\UnionsTable $Unions
 *
 * @method \App\Model\Entity\Union[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UnionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $unions = $this->paginate($this->Unions);

        $this->set(compact('unions'));
    }

    /**
     * View method
     *
     * @param string|null $id Union id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $union = $this->Unions->get($id, [
            'contain' => []
        ]);

        $this->set('union', $union);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $union = $this->Unions->newEntity();
        if ($this->request->is('post')) {
            $union = $this->Unions->patchEntity($union, $this->request->getData());
            if ($this->Unions->save($union)) {
                $this->Flash->success(__('The union has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The union could not be saved. Please, try again.'));
        }
        $this->set(compact('union'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Union id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $union = $this->Unions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $union = $this->Unions->patchEntity($union, $this->request->getData());
            if ($this->Unions->save($union)) {
                $this->Flash->success(__('The union has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The union could not be saved. Please, try again.'));
        }
        $this->set(compact('union'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Union id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $union = $this->Unions->get($id);
        if ($this->Unions->delete($union)) {
            $this->Flash->success(__('The union has been deleted.'));
        } else {
            $this->Flash->error(__('The union could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
