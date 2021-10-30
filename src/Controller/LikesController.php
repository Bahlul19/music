<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Likes Controller
 *
 * @property \App\Model\Table\LikesTable $Likes
 *
 * @method \App\Model\Entity\Like[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LikesController extends AppController
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
        $likes = $this->paginate($this->Likes);

        $this->set(compact('likes'));
    }

    /**
     * View method
     *
     * @param string|null $id Like id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $like = $this->Likes->get($id, [
            'contain' => ['Medias', 'Users']
        ]);

        $this->set('like', $like);
    }



    public function hitlike($id = null)
    {
        $this->autoRender = false;
        $Like = $this->Likes->newEntity();
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $data['media_id'] = $id;
        $data['user_id'] = $currentuserid;
        $data['created'] = date("Y-m-d h:i:s");

        $alllikes = $this->Likes->find('all')->where(['media_id'=>$id,'user_id'=>$currentuserid]);
        $alllikescounter = 0;
        foreach($alllikes as $alllike)
        {
            $Like = $this->Likes->get($alllike->id);
            $this->Likes->delete($Like);
            $alllikescounter++;
        }
        if($alllikescounter == 0)
        {
            $Like = $this->Likes->patchEntity($Like, $data);
            if ($this->Likes->save($Like)) {

                $query = $this->Likes->find('all')->where(['media_id' => $id]);
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
            $query = $this->Likes->find('all')->where(['media_id' => $id]);
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
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $like = $this->Likes->newEntity();
        if ($this->request->is('post')) {
            $like = $this->Likes->patchEntity($like, $this->request->getData());
            if ($this->Likes->save($like)) {
                $this->Flash->success(__('The like has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The like could not be saved. Please, try again.'));
        }
        $media = $this->Likes->Medias->find('list', ['limit' => 200]);
        $users = $this->Likes->Users->find('list', ['limit' => 200]);
        $this->set(compact('like', 'media', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Like id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $like = $this->Likes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $like = $this->Likes->patchEntity($like, $this->request->getData());
            if ($this->Likes->save($like)) {
                $this->Flash->success(__('The like has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The like could not be saved. Please, try again.'));
        }
        $media = $this->Likes->Medias->find('list', ['limit' => 200]);
        $users = $this->Likes->Users->find('list', ['limit' => 200]);
        $this->set(compact('like', 'media', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Like id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $like = $this->Likes->get($id);
        if ($this->Likes->delete($like)) {
            $this->Flash->success(__('The like has been deleted.'));
        } else {
            $this->Flash->error(__('The like could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
