<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MediaTags Controller
 *
 * @property \App\Model\Table\MediaTagsTable $MediaTags
 *
 * @method \App\Model\Entity\MediaTag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MediaTagsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $mediaTags = $this->paginate($this->MediaTags);

        $this->set(compact('mediaTags'));
    }

    /**
     * View method
     *
     * @param string|null $id Media Tag id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mediaTag = $this->MediaTags->get($id, [
            'contain' => []
        ]);

        $this->set('mediaTag', $mediaTag);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mediaTag = $this->MediaTags->newEntity();
        if ($this->request->is('post')) {
            $mediaTag = $this->MediaTags->patchEntity($mediaTag, $this->request->getData());
            if ($this->MediaTags->save($mediaTag)) {
                $this->Flash->success(__('The media tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media tag could not be saved. Please, try again.'));
        }
        $this->set(compact('mediaTag'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Media Tag id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mediaTag = $this->MediaTags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mediaTag = $this->MediaTags->patchEntity($mediaTag, $this->request->getData());
            if ($this->MediaTags->save($mediaTag)) {
                $this->Flash->success(__('The media tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media tag could not be saved. Please, try again.'));
        }
        $this->set(compact('mediaTag'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Media Tag id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mediaTag = $this->MediaTags->get($id);
        if ($this->MediaTags->delete($mediaTag)) {
            $this->Flash->success(__('The media tag has been deleted.'));
        } else {
            $this->Flash->error(__('The media tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
