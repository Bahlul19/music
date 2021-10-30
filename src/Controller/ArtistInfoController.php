<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ArtistInfo Controller
 *
 * @property \App\Model\Table\ArtistInfoTable $ArtistInfo
 *
 * @method \App\Model\Entity\ArtistInfo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArtistInfoController extends AppController
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
        $artistInfo = $this->paginate($this->ArtistInfo);

        $this->set(compact('artistInfo'));
    }

    /**
     * View method
     *
     * @param string|null $id Artist Info id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $artistInfo = $this->ArtistInfo->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('artistInfo', $artistInfo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $artistInfo = $this->ArtistInfo->newEntity();
        if ($this->request->is('post')) {
            $artistInfo = $this->ArtistInfo->patchEntity($artistInfo, $this->request->getData());
            if ($this->ArtistInfo->save($artistInfo)) {
                $this->Flash->success(__('The artist info has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The artist info could not be saved. Please, try again.'));
        }
        $users = $this->ArtistInfo->Users->find('list', ['limit' => 200]);
        $this->set(compact('artistInfo', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Artist Info id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $artistInfo = $this->ArtistInfo->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $artistInfo = $this->ArtistInfo->patchEntity($artistInfo, $this->request->getData());
            if ($this->ArtistInfo->save($artistInfo)) {
                $this->Flash->success(__('The artist info has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The artist info could not be saved. Please, try again.'));
        }
        $users = $this->ArtistInfo->Users->find('list', ['limit' => 200]);
        $this->set(compact('artistInfo', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Artist Info id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $artistInfo = $this->ArtistInfo->get($id);
        if ($this->ArtistInfo->delete($artistInfo)) {
            $this->Flash->success(__('The artist info has been deleted.'));
        } else {
            $this->Flash->error(__('The artist info could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
