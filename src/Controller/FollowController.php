<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Follow Controller
 *
 * @property \App\Model\Table\FollowTable $Follow
 *
 * @method \App\Model\Entity\Follow[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FollowController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $follow = $this->paginate($this->Follow);

        $this->set(compact('follow'));
    }

    /**
     * View method
     *
     * @param string|null $id Follow id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $follow = $this->Follow->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('follow', $follow);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $follow = $this->Follow->newEntity();
        if ($this->request->is('post')) {
            $follow = $this->Follow->patchEntity($follow, $this->request->getData());
            if ($this->Follow->save($follow)) {
                $this->Flash->success(__('The follow has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The follow could not be saved. Please, try again.'));
        }
        $users = $this->Follow->Users->find('list', ['limit' => 200]);
        $this->set(compact('follow', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Follow id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $follow = $this->Follow->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $follow = $this->Follow->patchEntity($follow, $this->request->getData());
            if ($this->Follow->save($follow)) {
                $this->Flash->success(__('The follow has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The follow could not be saved. Please, try again.'));
        }
        $users = $this->Follow->Users->find('list', ['limit' => 200]);
        $this->set(compact('follow', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Follow id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $follow = $this->Follow->get($id);
        if ($this->Follow->delete($follow)) {
            $this->Flash->success(__('The follow has been deleted.'));
        } else {
            $this->Flash->error(__('The follow could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
