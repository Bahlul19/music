<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Myprofile Controller
 *
 * @property \App\Model\Table\MyprofileTable $Myprofile
 *
 * @method \App\Model\Entity\Myprofile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MyprofileController extends AppController
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
        $myprofile = $this->paginate($this->Myprofile);

        $this->set(compact('myprofile'));
    }

    /**
     * View method
     *
     * @param string|null $id Myprofile id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $myprofile = $this->Myprofile->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('myprofile', $myprofile);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $myprofile = $this->Myprofile->newEntity();
        if ($this->request->is('post')) {
            $myprofile = $this->Myprofile->patchEntity($myprofile, $this->request->getData());
            if ($this->Myprofile->save($myprofile)) {
                $this->Flash->success(__('The myprofile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The myprofile could not be saved. Please, try again.'));
        }
        $users = $this->Myprofile->Users->find('list', ['limit' => 200]);
        $this->set(compact('myprofile', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Myprofile id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $myprofile = $this->Myprofile->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $myprofile = $this->Myprofile->patchEntity($myprofile, $this->request->getData());
            if ($this->Myprofile->save($myprofile)) {
                $this->Flash->success(__('The myprofile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The myprofile could not be saved. Please, try again.'));
        }
        $users = $this->Myprofile->Users->find('list', ['limit' => 200]);
        $this->set(compact('myprofile', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Myprofile id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $myprofile = $this->Myprofile->get($id);
        if ($this->Myprofile->delete($myprofile)) {
            $this->Flash->success(__('The myprofile has been deleted.'));
        } else {
            $this->Flash->error(__('The myprofile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
