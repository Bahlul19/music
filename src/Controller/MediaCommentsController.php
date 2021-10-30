<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MediaComments Controller
 *
 * @property \App\Model\Table\MediaCommentsTable $MediaComments
 *
 * @method \App\Model\Entity\MediaComment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MediaCommentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Media', 'Users']
        ];
        $mediaComments = $this->paginate($this->MediaComments);

        $this->set(compact('mediaComments'));
    }

    /**
     * View method
     *
     * @param string|null $id Media Comment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mediaComment = $this->MediaComments->get($id, [
            'contain' => ['Media', 'Users']
        ]);

        $this->set('mediaComment', $mediaComment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mediaComment = $this->MediaComments->newEntity();
        if ($this->request->is('post')) {
            $mediaComment = $this->MediaComments->patchEntity($mediaComment, $this->request->getData());
            if ($this->MediaComments->save($mediaComment)) {
                $this->Flash->success(__('The media comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media comment could not be saved. Please, try again.'));
        }
        $media = $this->MediaComments->Media->find('list', ['limit' => 200]);
        $users = $this->MediaComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('mediaComment', 'media', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Media Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mediaComment = $this->MediaComments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mediaComment = $this->MediaComments->patchEntity($mediaComment, $this->request->getData());
            if ($this->MediaComments->save($mediaComment)) {
                $this->Flash->success(__('The media comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media comment could not be saved. Please, try again.'));
        }
        $media = $this->MediaComments->Media->find('list', ['limit' => 200]);
        $users = $this->MediaComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('mediaComment', 'media', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Media Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mediaComment = $this->MediaComments->get($id);
        if ($this->MediaComments->delete($mediaComment)) {
            $this->Flash->success(__('The media comment has been deleted.'));
        } else {
            $this->Flash->error(__('The media comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


  public function comment()
  {
        $this->autoRender = false;
        if($this->request->is('ajax'))
        {
        $notificationLike = $this->MediaComments->newEntity();
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $data['media_id'] =(int)$this->request->getData()['id'];
        $data['user_id'] = $currentuserid;
        $data['comment'] = $this->request->getData()['comment'];
        $notificationLike = $this->MediaComments->patchEntity($notificationLike, $data);
            if ($this->MediaComments->save($notificationLike)) {
                $query = $this->MediaComments->find('all')->where(['media_id' => $this->request->getData()['id']]);
                $counter =0;
                foreach ($query as $key) {
                   $counter++;
                }
                $response = ["status"=>1,"count"=>$counter];
                echo json_encode($response,true);

                }
            else
            {
                debug($notificationLike->errors());
            $response = ["status"=>0];
                echo json_encode($response,true);
            }
        }
        die();
    }
}
