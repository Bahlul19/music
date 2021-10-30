<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Friends Controller
 *
 * @property \App\Model\Table\FriendsTable $Friends
 *
 * @method \App\Model\Entity\Friend[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FriendsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $friends = $this->paginate($this->Friends);

        $this->set(compact('friends'));
    }

    /**
     * View method
     *
     * @param string|null $id Friend id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $friend = $this->Friends->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('friend', $friend);
    }
    public function viewartist()
    {
    }
    public function viewfriends()
    {
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
         $friend = $this->Friends->find('all')->where(['OR' => [
            ['Friends.user_id' => $currentuserid, ['OR' => [
            ['Friends.status' => 1],
            ['Friends.status' => 3]]]],
            ['Friends.friend_user_id' => $currentuserid, ['OR' => [
            ['Friends.status' => 1],
            ['Friends.status' => 3]]]]
        ]]);
         $this->set('friendreqcount', 0);
        $friendsarray = array();
        foreach ($friend as $row) {
            if($row->user_id == $currentuserid)
            {
                $friendsarray[] = $row->friend_user_id;
            }
            else
            {
                $friendsarray[] = $row->user_id;
            }
        }
        if(count($friendsarray) != 0)
        {
             $result = $this->loadModel('Users');
             $data = $result->find('all')->where(
                ['Users.id IN' => $friendsarray]
             )->contain(['Profiles','Medias']);
             $this->set('friendreqcount',count($friendsarray));
            $this->set('friend', $data);
        }
    }

    public function viewfriendrequest()
    {
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $friend = $this->Friends->find('all')->where([
            ['Friends.friend_user_id' => $currentuserid,
            'Friends.status' => 0]
        ]);
        $this->set('friendreqcount', 0);
        $friendsarray = array();
        foreach ($friend as $row) {
            if($row->user_id == $currentuserid)
            {
                $friendsarray[] = $row->friend_user_id;
            }
            else
            {
                $friendsarray[] = $row->user_id;
            }
        }
        if(count($friendsarray) != 0)
        {
             $result = $this->loadModel('Users');
             $data = $result->find('all')->where(
                ['Users.id IN' => $friendsarray]
             )->contain(['Profiles','Medias']);
             $this->set('friendreqcount',count($friendsarray));
             $this->set('friend', $data);
        }

    }



    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $friend = $this->Friends->newEntity();
        if ($this->request->is('post')) {
            $friend = $this->Friends->patchEntity($friend, $this->request->getData());
            if ($this->Friends->save($friend)) {
                $this->Flash->success(__('The friend has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The friend could not be saved. Please, try again.'));
        }
        $users = $this->Friends->Users->find('list', ['limit' => 200]);
        $friendUsers = $this->Friends->FriendUsers->find('list', ['limit' => 200]);
        $this->set(compact('friend', 'users', 'friendUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Friend id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $friend = $this->Friends->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $friend = $this->Friends->patchEntity($friend, $this->request->getData());
            if ($this->Friends->save($friend)) {
                $this->Flash->success(__('The friend has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The friend could not be saved. Please, try again.'));
        }
        $users = $this->Friends->Users->find('list', ['limit' => 200]);
        $friendUsers = $this->Friends->FriendUsers->find('list', ['limit' => 200]);
        $this->set(compact('friend', 'users', 'friendUsers'));
    }




    /**
     * Delete method
     *
     * @param string|null $id Friend id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $friend = $this->Friends->get($id);
        if ($this->Friends->delete($friend)) {
            $this->Flash->success(__('The friend has been deleted.'));
        } else {
            $this->Flash->error(__('The friend could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
