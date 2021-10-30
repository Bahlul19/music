<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NotificationComments Controller
 *
 * @property \App\Model\Table\NotificationCommentsTable $NotificationComments
 *
 * @method \App\Model\Entity\NotificationComment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotificationCommentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Notifications', 'Users']
        ];
        $notificationComments = $this->paginate($this->NotificationComments);

        $this->set(compact('notificationComments'));
    }

    /**
     * View method
     *
     * @param string|null $id Notification Comment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notificationComment = $this->NotificationComments->get($id, [
            'contain' => ['Notifications', 'Users']
        ]);

        $this->set('notificationComment', $notificationComment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notificationComment = $this->NotificationComments->newEntity();
        if ($this->request->is('post')) {
            $notificationComment = $this->NotificationComments->patchEntity($notificationComment, $this->request->getData());
            if ($this->NotificationComments->save($notificationComment)) {
                $this->Flash->success(__('The notification comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification comment could not be saved. Please, try again.'));
        }
        $notifications = $this->NotificationComments->Notifications->find('list', ['limit' => 200]);
        $users = $this->NotificationComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('notificationComment', 'notifications', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Notification Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notificationComment = $this->NotificationComments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notificationComment = $this->NotificationComments->patchEntity($notificationComment, $this->request->getData());
            if ($this->NotificationComments->save($notificationComment)) {
                $this->Flash->success(__('The notification comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification comment could not be saved. Please, try again.'));
        }
        $notifications = $this->NotificationComments->Notifications->find('list', ['limit' => 200]);
        $users = $this->NotificationComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('notificationComment', 'notifications', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Notification Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notificationComment = $this->NotificationComments->get($id);
        if ($this->NotificationComments->delete($notificationComment)) {
            $this->Flash->success(__('The notification comment has been deleted.'));
        } else {
            $this->Flash->error(__('The notification comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function comment()
    {
        $this->autoRender = false;
        if($this->request->is('ajax'))
        {
        $notificationLike = $this->NotificationComments->newEntity();
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $data['notification_id'] =(int)$this->request->getData()['id'];
        $data['user_id'] = $currentuserid;
        $data['comment'] = $this->request->getData()['comment'];
        $notificationLike = $this->NotificationComments->patchEntity($notificationLike, $data);
            if ($this->NotificationComments->save($notificationLike)) {

                $query = $this->NotificationComments->find('all')->where(['notification_id' => $this->request->getData()['id']]);
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
