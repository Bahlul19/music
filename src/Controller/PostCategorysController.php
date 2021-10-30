<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PostCategorys Controller
 *
 * @property \App\Model\Table\PostCategorysTable $PostCategorys
 *
 * @method \App\Model\Entity\PostCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostCategorysController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $postCategorys = $this->paginate($this->PostCategorys);

        $this->set(compact('postCategorys'));
    }

    /**
     * View method
     *
     * @param string|null $id Post Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $postCategory = $this->PostCategorys->get($id, [
            'contain' => ['Posts']
        ]);

        $this->set('postCategory', $postCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $postCategory = $this->PostCategorys->newEntity();
        if ($this->request->is('post')) {
            $postCategory = $this->PostCategorys->patchEntity($postCategory, $this->request->getData());
            if ($this->PostCategorys->save($postCategory)) {
                $this->Flash->success(__('The post category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post category could not be saved. Please, try again.'));
        }
        $this->set(compact('postCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $postCategory = $this->PostCategorys->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postCategory = $this->PostCategorys->patchEntity($postCategory, $this->request->getData());
            if ($this->PostCategorys->save($postCategory)) {
                $this->Flash->success(__('The post category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post category could not be saved. Please, try again.'));
        }
        $this->set(compact('postCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $postCategory = $this->PostCategorys->get($id);
        if ($this->PostCategorys->delete($postCategory)) {
            $this->Flash->success(__('The post category has been deleted.'));
        } else {
            $this->Flash->error(__('The post category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
