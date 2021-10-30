<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NotificationLikes Controller
 *
 * @property \App\Model\Table\NotificationLikesTable $NotificationLikes
 *
 * @method \App\Model\Entity\NotificationLike[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotificationLikesController extends AppController
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
        $notificationLikes = $this->paginate($this->NotificationLikes);

        $this->set(compact('notificationLikes'));
    }

    /**
     * View method
     *
     * @param string|null $id Notification Like id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notificationLike = $this->NotificationLikes->get($id, [
            'contain' => ['Notifications', 'Users']
        ]);

        $this->set('notificationLike', $notificationLike);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notificationLike = $this->NotificationLikes->newEntity();
        if ($this->request->is('post')) {
            $notificationLike = $this->NotificationLikes->patchEntity($notificationLike, $this->request->getData());
            if ($this->NotificationLikes->save($notificationLike)) {
                $this->Flash->success(__('The notification like has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification like could not be saved. Please, try again.'));
        }
        $notifications = $this->NotificationLikes->Notifications->find('list', ['limit' => 200]);
        $users = $this->NotificationLikes->Users->find('list', ['limit' => 200]);
        $this->set(compact('notificationLike', 'notifications', 'users'));
    }

    public function hitlike($id = null)
    {
        $this->autoRender = false;
        $notificationLike = $this->NotificationLikes->newEntity();
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $data['notification_id'] = $id;
        $data['user_id'] = $currentuserid;


        $alllikes = $this->NotificationLikes->find('all')->where(['notification_id'=>$id,'user_id'=>$currentuserid]);
        $alllikescounter = 0;
        foreach($alllikes as $alllike)
        {
            $notificationLike = $this->NotificationLikes->get($alllike->id);
            $this->NotificationLikes->delete($notificationLike);
            $alllikescounter++;
        }
        if($alllikescounter == 0)
        {
            $notificationLike = $this->NotificationLikes->patchEntity($notificationLike, $data);
            if ($this->NotificationLikes->save($notificationLike)) {

                $query = $this->NotificationLikes->find('all')->where(['notification_id' => $id]);
                $counter =0;
                foreach ($query as $key) {
                   $counter++;
                }
                $response = ["status"=>1,"count"=>$counter];
                echo json_encode($response,true);
            }
            else
            {
            $response = ["status"=>0];
                echo json_encode($response,true);
            }
        }
        else
        {
            $query = $this->NotificationLikes->find('all')->where(['notification_id' => $id]);
                $counter =0;
                foreach ($query as $key) {
                   $counter++;
                }
                $response = ["status"=>1,"count"=>$counter];
                echo json_encode($response,true);
        }
        die();
    }

    /**
     * Edit method
     *
     * @param string|null $id Notification Like id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notificationLike = $this->NotificationLikes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notificationLike = $this->NotificationLikes->patchEntity($notificationLike, $this->request->getData());
            if ($this->NotificationLikes->save($notificationLike)) {
                $this->Flash->success(__('The notification like has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification like could not be saved. Please, try again.'));
        }
        $notifications = $this->NotificationLikes->Notifications->find('list', ['limit' => 200]);
        $users = $this->NotificationLikes->Users->find('list', ['limit' => 200]);
        $this->set(compact('notificationLike', 'notifications', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Notification Like id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notificationLike = $this->NotificationLikes->get($id);
        if ($this->NotificationLikes->delete($notificationLike)) {
            $this->Flash->success(__('The notification like has been deleted.'));
        } else {
            $this->Flash->error(__('The notification like could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
