<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NotificationRatings Controller
 *
 * @property \App\Model\Table\NotificationRatingsTable $NotificationRatings
 *
 * @method \App\Model\Entity\NotificationRating[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotificationRatingsController extends AppController
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
        $notificationRatings = $this->paginate($this->NotificationRatings);

        $this->set(compact('notificationRatings'));
    }

    /**
     * View method
     *
     * @param string|null $id Notification Rating id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notificationRating = $this->NotificationRatings->get($id, [
            'contain' => ['Notifications', 'Users']
        ]);

        $this->set('notificationRating', $notificationRating);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notificationRating = $this->NotificationRatings->newEntity();
        if ($this->request->is('post')) {
            $notificationRating = $this->NotificationRatings->patchEntity($notificationRating, $this->request->getData());
            if ($this->NotificationRatings->save($notificationRating)) {
                $this->Flash->success(__('The notification rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification rating could not be saved. Please, try again.'));
        }
        $media = $this->NotificationRatings->Notifications->find('list', ['limit' => 200]);
        $users = $this->NotificationRatings->Users->find('list', ['limit' => 200]);
        $this->set(compact('notificationRating', 'media', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Notification Rating id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notificationRating = $this->NotificationRatings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notificationRating = $this->NotificationRatings->patchEntity($notificationRating, $this->request->getData());
            if ($this->NotificationRatings->save($notificationRating)) {
                $this->Flash->success(__('The notification rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification rating could not be saved. Please, try again.'));
        }
        $media = $this->NotificationRatings->Notifications->find('list', ['limit' => 200]);
        $users = $this->NotificationRatings->Users->find('list', ['limit' => 200]);
        $this->set(compact('notificationRating', 'media', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Notification Rating id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notificationRating = $this->NotificationRatings->get($id);
        if ($this->NotificationRatings->delete($notificationRating)) {
            $this->Flash->success(__('The notification rating has been deleted.'));
        } else {
            $this->Flash->error(__('The notification rating could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function giveRating($id = null,$rating = null)
    {
        $this->autoRender = false;
        $Like = $this->NotificationRatings->newEntity();
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $data['notification_id'] = $id;
        $data['user_id'] = $currentuserid;
        $data['rating'] = $rating;
        $data['created'] = date("Y-m-d h:i:s");

        $alllikes = $this->NotificationRatings->find('all')->where(['notification_id'=>$id,'user_id'=>$currentuserid]);
        $alllikescounter = 0;
        foreach($alllikes as $alllike)
        {
            $Like2 = $this->NotificationRatings->get($alllike->id);
            $Like2->rating = $rating;
            $this->NotificationRatings->save($Like2);
                $query = $this->NotificationRatings->find('all')->where(['notification_id' => $id]);
                $counter =0;
                $ratingcounter =0;
                foreach ($query as $key) {
                   $counter++;
                   $ratingcounter = $ratingcounter + (float)$key->rating;
                }

                $avg = $ratingcounter/$counter;
                $response = ["status"=>1,"count"=>$avg];
                echo json_encode($response,true);
            $alllikescounter++;
        }
        if($alllikescounter == 0)
        {
            $Like = $this->NotificationRatings->patchEntity($Like, $data);
            if ($this->NotificationRatings->save($Like)) {

                $query = $this->NotificationRatings->find('all')->where(['notification_id' => $id]);
                $counter =0;
                $ratingcounter =0;
                foreach ($query as $key) {
                   $counter++;
                   $ratingcounter = $ratingcounter + (float)$key->rating;
                }
                $avg = $ratingcounter/$counter;
                $response = ["status"=>1,"count"=>$avg];
                echo json_encode($response,true);
            }
            else
            {
            $response = ["status"=>0];
                echo json_encode($response,true);
            }
            die();
        }

    }
}
