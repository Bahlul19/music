<?php
namespace App\Controller\Admin;
use cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use App\Controller\Admin\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * RadioTracks Controller
 *
 * @property \App\Model\Table\RadioTracksTable $RadioTracks
 *
 * @method \App\Model\Entity\RadioTrack[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RadioTracksController extends AppController
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
        $radioTracks = $this->paginate($this->RadioTracks);

        $this->set(compact('radioTracks'));
    }

    /**
     * View method
     *
     * @param string|null $id Radio Track id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $radioTrack = $this->RadioTracks->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('radioTrack', $radioTrack);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $radioTrack = $this->RadioTracks->newEntity();
        $user_id = $this->Auth->user('id');
        $data = $this->request->getData("audio");
        if ($this->request->is('post')) {
            $passedData = $this->request->getData();
            $passedData['user_id'] = $user_id;

             if($data['tmp_name'] !=NULL){
                            $imgTmp=$data['tmp_name'];
                            $folder="files/audio/";
                            $dir = new Folder();
                            $dir->create(WWW_ROOT . 'files/audio/');
                            if($imgTmp !='')
                            {
                                move_uploaded_file($imgTmp, $folder.$data['name']);
                            }
                        }

            $passedData['track'] = $folder.$data['name'];
            $radioTrack = $this->RadioTracks->patchEntity($radioTrack, $passedData);
            if ($this->RadioTracks->save($radioTrack)) {
                $this->Flash->success(__('The radio track has been saved.'));

               return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The radio track could not be saved. Please, try again.'));
        }
        $this->set(compact('radioTrack'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Radio Track id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user_id = $this->Auth->user('id');
        $radioTrack = $this->RadioTracks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $passedData = $this->request->getData();
            $passedData['user_id'] = $user_id;
            $radioTrack = $this->RadioTracks->patchEntity($radioTrack, $passedData);
            if ($this->RadioTracks->save($radioTrack)) {
                $this->Flash->success(__('The radio track has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The radio track could not be saved. Please, try again.'));
        }
        $this->set(compact('radioTrack'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Radio Track id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $radioTrack = $this->RadioTracks->get($id);
        if ($this->RadioTracks->delete($radioTrack)) {
            $this->Flash->success(__('The radio track has been deleted.'));
        } else {
            $this->Flash->error(__('The radio track could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function updateStatus($id = null)
    {
        $this->request->allowMethod(['post']);
        $radioTrack = $this->RadioTracks->get($id);
        $radioTrack->active = 1;
        if ($this->RadioTracks->save($radioTrack)) {

            $this->RadioTracks->updateAll(['active'=>'0'],['id != '=>$id]);
            $this->Flash->success(__('The radio track has been set.'));
        } else {
            $this->Flash->error(__('Unable to set the Track.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
