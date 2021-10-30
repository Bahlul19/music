<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PostTags Controller
 *
 * @property \App\Model\Table\PostTagsTable $PostTags
 *
 * @method \App\Model\Entity\PostTag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostTagsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $postTags = $this->paginate($this->PostTags);

        $this->set(compact('postTags'));
    }

    /**
     * View method
     *
     * @param string|null $id Post Tag id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $postTag = $this->PostTags->get($id, [
            'contain' => ['Posts']
        ]);

        $this->set('postTag', $postTag);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $postTag = $this->PostTags->newEntity();
        if ($this->request->is('post')) {
            $postTag = $this->PostTags->patchEntity($postTag, $this->request->getData());
            if ($this->PostTags->save($postTag)) {
                $this->Flash->success(__('The post tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post tag could not be saved. Please, try again.'));
        }
        $this->set(compact('postTag'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post Tag id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $postTag = $this->PostTags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postTag = $this->PostTags->patchEntity($postTag, $this->request->getData());
            if ($this->PostTags->save($postTag)) {
                $this->Flash->success(__('The post tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post tag could not be saved. Please, try again.'));
        }
        $this->set(compact('postTag'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post Tag id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $postTag = $this->PostTags->get($id);
        if ($this->PostTags->delete($postTag)) {
            $this->Flash->success(__('The post tag has been deleted.'));
        } else {
            $this->Flash->error(__('The post tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
