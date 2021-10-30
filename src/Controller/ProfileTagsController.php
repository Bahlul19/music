<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProfileTags Controller
 *
 * @property \App\Model\Table\ProfileTagsTable $ProfileTags
 *
 * @method \App\Model\Entity\ProfileTag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProfileTagsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $profileTags = $this->paginate($this->ProfileTags);

        $this->set(compact('profileTags'));
    }

    /**
     * View method
     *
     * @param string|null $id Profile Tag id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $profileTag = $this->ProfileTags->get($id, [
            'contain' => []
        ]);

        $this->set('profileTag', $profileTag);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $profileTag = $this->ProfileTags->newEntity();
        if ($this->request->is('post')) {
            $profileTag = $this->ProfileTags->patchEntity($profileTag, $this->request->getData());
            if ($this->ProfileTags->save($profileTag)) {
                $this->Flash->success(__('The profile tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile tag could not be saved. Please, try again.'));
        }
        $this->set(compact('profileTag'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Profile Tag id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $profileTag = $this->ProfileTags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profileTag = $this->ProfileTags->patchEntity($profileTag, $this->request->getData());
            if ($this->ProfileTags->save($profileTag)) {
                $this->Flash->success(__('The profile tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile tag could not be saved. Please, try again.'));
        }
        $this->set(compact('profileTag'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Profile Tag id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $profileTag = $this->ProfileTags->get($id);
        if ($this->ProfileTags->delete($profileTag)) {
            $this->Flash->success(__('The profile tag has been deleted.'));
        } else {
            $this->Flash->error(__('The profile tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
