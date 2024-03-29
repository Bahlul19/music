<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ratings Controller
 *
 * @property \App\Model\Table\RatingsTable $Ratings
 *
 * @method \App\Model\Entity\Rating[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Medias', 'Users']
        ];
        $ratings = $this->paginate($this->Ratings);

        $this->set(compact('ratings'));
    }

    /**
     * View method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rating = $this->Ratings->get($id, [
            'contain' => ['Medias', 'Users']
        ]);

        $this->set('rating', $rating);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rating = $this->Ratings->newEntity();
        if ($this->request->is('post')) {
            $rating = $this->Ratings->patchEntity($rating, $this->request->getData());
            if ($this->Ratings->save($rating)) {
                $this->Flash->success(__('The rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rating could not be saved. Please, try again.'));
        }
        $media = $this->Ratings->Medias->find('list', ['limit' => 200]);
        $users = $this->Ratings->Users->find('list', ['limit' => 200]);
        $this->set(compact('rating', 'media', 'users'));
    }

    public function giveRating($id = null,$rating = null)
    {
        $this->autoRender = false;
        $Like = $this->Ratings->newEntity();
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $data['media_id'] = $id;
        $data['user_id'] = $currentuserid;
        $data['rating'] = $rating;
        $data['created'] = date("Y-m-d h:i:s");

        $alllikes = $this->Ratings->find('all')->where(['media_id'=>$id,'user_id'=>$currentuserid]);
        $alllikescounter = 0;
        foreach($alllikes as $alllike)
        {
            $Like2 = $this->Ratings->get($alllike->id);
            $Like2->rating = $rating;
            $this->Ratings->save($Like2);
                $query = $this->Ratings->find('all')->where(['media_id' => $id]);
                $counter =0;
                $ratingcounter =0;
                foreach ($query as $key) {
                   $counter++;
                   $ratingcounter = $ratingcounter + (float)$key->rating;
                }
                $this->loadModel('MediaMetas');
                $getmediametas = $this->MediaMetas->find('all')->where(['media_id'=>$id]);

                foreach ($getmediametas as $getmediametass) {
                    $mmid = $getmediametass->id;
                    break;
                }
                $avg = $ratingcounter/$counter;
                $firstrow2 = $this->MediaMetas->get($mmid);
                $firstrow2->ratings = (int)$avg;
                $this->MediaMetas->save($firstrow2);
                $response = ["status"=>1,"count"=>$avg];
                echo json_encode($response,true);
            $alllikescounter++;
        }
        if($alllikescounter == 0)
        {
            $Like = $this->Ratings->patchEntity($Like, $data);
            if ($this->Ratings->save($Like)) {

                $query = $this->Ratings->find('all')->where(['media_id' => $id]);
                $counter =0;
                $ratingcounter =0;
                foreach ($query as $key) {
                   $counter++;
                   $ratingcounter = $ratingcounter + (float)$key->rating;
                }


                $this->loadModel('MediaMetas');
                $getmediametas = $this->MediaMetas->find('all')->where(['media_id'=>$id]);

                foreach ($getmediametas as $getmediametass) {
                    $mmid = $getmediametass->id;
                    break;
                }

                /*$firstrow = $getmediametas->first();
                $firstrow->ratings = $ratingcounter;*/
                $avg = $ratingcounter/$counter;

                $firstrow2 = $this->MediaMetas->get($mmid);
                $firstrow2->ratings = (int)$avg;


                $this->MediaMetas->save($firstrow2);

               /* $this->MediaMetas->save($firstrow);
                debug($firstrow->errors());/**/

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
        /*else
        {
            $query = $this->Ratings->find('all')->where(['media_id' => $id]);
                $counter =0;
                foreach ($query as $key) {
                   $counter++;
                }
                $response = ["status"=>1,"count"=>$counter];
                echo json_encode($response,true);
        }*/
    }
    /**
     * Edit method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rating = $this->Ratings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rating = $this->Ratings->patchEntity($rating, $this->request->getData());
            if ($this->Ratings->save($rating)) {
                $this->Flash->success(__('The rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rating could not be saved. Please, try again.'));
        }
        $media = $this->Ratings->Medias->find('list', ['limit' => 200]);
        $users = $this->Ratings->Users->find('list', ['limit' => 200]);
        $this->set(compact('rating', 'media', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rating = $this->Ratings->get($id);
        if ($this->Ratings->delete($rating)) {
            $this->Flash->success(__('The rating has been deleted.'));
        } else {
            $this->Flash->error(__('The rating could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
