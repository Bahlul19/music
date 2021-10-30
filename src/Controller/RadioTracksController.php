<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RadioTracks Controller
 *
 * @property \App\Model\Table\RadioTracksTable $RadioTracks
 *
 * @method \App\Model\Entity\RadioTrack[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RadioTracksController extends AppController
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
        $radioTracks = $this->paginate($this->RadioTracks);

        $this->set(compact('radioTracks'));
    }

    /**
     * View method
     *
     * @param string|null $id Radio Track id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $radioTrack = $this->RadioTracks->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('radioTrack', $radioTrack);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $radioTrack = $this->RadioTracks->newEntity();
        echo $user_id = $this->Auth->user('id');
        exit;
        if ($this->request->is('post')) {
            $passedData = $this->request->getData();
            $passedData['user_id'] = $user_id;
            $radioTrack = $this->RadioTracks->patchEntity($radioTrack, $passedData);
            if ($this->RadioTracks->save($radioTrack)) {
                $this->Flash->success(__('The radio track has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The radio track could not be saved. Please, try again.'));
        }
        $this->set(compact('radioTrack'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Radio Track id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $radioTrack = $this->RadioTracks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $radioTrack = $this->RadioTracks->patchEntity($radioTrack, $this->request->getData());
            if ($this->RadioTracks->save($radioTrack)) {
                $this->Flash->success(__('The radio track has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The radio track could not be saved. Please, try again.'));
        }
        $users = $this->RadioTracks->Users->find('list', ['limit' => 200]);
        $this->set(compact('radioTrack', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Radio Track id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $radioTrack = $this->RadioTracks->get($id);
        if ($this->RadioTracks->delete($radioTrack)) {
            $this->Flash->success(__('The radio track has been deleted.'));
        } else {
            $this->Flash->error(__('The radio track could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
