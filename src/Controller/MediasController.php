<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\ORM\TableRegistry;
/**
 * Medias Controller
 *
 * @property \App\Model\Table\MediasTable $Medias
 *
 * @method \App\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MediasController extends AppController
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
        $medias = $this->paginate($this->Medias);
        $this->set(compact('medias'));
    }

    /**
     * View method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $media = $this->Medias->get($id, [
            'contain' => ['Users', 'Comments', 'Likes', 'MediaMetas', 'Posts', 'Profiles']
        ]);

        $this->set('media', $media);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $media = $this->Medias->newEntity();
        if ($this->request->is('post')) {
            $media = $this->Medias->patchEntity($media, $this->request->getData());
            if ($this->Medias->save($media)) {
                $this->Flash->success(__('The media has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $users = $this->Medias->Users->find('list', ['limit' => 200]);
        $this->set(compact('media', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $media = $this->Medias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $media = $this->Medias->patchEntity($media, $this->request->getData());
            if ($this->Medias->save($media)) {
                $this->Flash->success(__('The media has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $users = $this->Medias->Users->find('list', ['limit' => 200]);
        $this->set(compact('media', 'users'));
    }

    public function saveProfileImage($id = null)
    {
        $this->autoRender = false;
        $media = $this->Medias->get($id, [
            'contain' => []
        ]);
        if($this->request->is('post','ajax')){
            $media = $this->Medias->patchEntity($media, $this->request->getData());
            $Profileimg = $this->request->getData();
            $imgTmp=$Profileimg['file']['tmp_name'];
            $folder="files/userData/".$Profileimg['user_id']."/profileImg/";
            $dir = new Folder();
            $dir->create(WWW_ROOT . 'files/userData/'.$Profileimg['user_id'].'/profileImg/');
            if($imgTmp !='')
            {
                $imgname=$Profileimg['file']['name'];
                $ans=move_uploaded_file($imgTmp, $folder.'profileimg.jpg');
               // unlink($folder.basename($media->name));
                //$media->name = $imgname;
                $media->name = 'profileimg.jpg';
            }
            if ($this->Medias->save($media)) {
                $this->response->body(json_encode('success'));
            }
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $media = $this->Medias->get($id);
        if ($this->Medias->delete($media)) {
            $this->Flash->success(__('The media has been deleted.'));
        } else {
            $this->Flash->error(__('The media could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'notifications','action' => 'mynotifications']);
    }

    /**
     * Insertmedia method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    public function mediainsert()
    {
         $uid = $this->Auth->user('id');
         // dd($uid);
        $media = $this->Medias->newEntity();

        $this->loadModel('Users');
        //new code

          $userRole = $this->Users->get($uid, [
            'contain' => ['UserRoles']
         ]);

          $userRoleID = $userRole->user_roles[0]->role_id;

        if($this->request->is('post'))
        {

            $this->request->data['user_id'] = $uid;
            /*for working with video upload*/

            // $this->loadModel('UserRoles');
            // $userRolesAccess = $this->UserRoles->find('all')->where(['role_id' => 4])->toArray();

            $conditionCheck = $this->Medias->find('list')->where(['user_id' => $uid, 'type' => 1])->count();
            //dd($conditionCheck);
            if($userRoleID == 4)
            {
                /*if($conditionCheck < 5)
                {*/
                    $this->request->data['status'] = 1;
                $media = $this->Medias->patchEntity($media, $this->request->getData());
                    if($this->Medias->save($media))
                    {
                        $mediaMetasTable = TableRegistry::get('media_metas');

                        $mediaMeta = $mediaMetasTable->newEntity();
                        $mediaMeta->media_id = $media->id;
                        $mediaMeta->description = $this->request->getData("description");
                       // $mediaMeta->tag = $this->request->getData("tag");
                        $mediaMeta->media_link = $this->request->getData("media_link");
                        $mediaMeta->title = $this->request->getData("title");
                        $mediaMeta->is_active = 1;
                        $mediaMetasTable->save($mediaMeta);

                        $this->Flash->set("Video saved",
                            [
                                'element' => 'success_message'
                            ]);
                        return $this->redirect($this->referer());
                    }
               // }

                /*else
                {
                     $this->Flash->set("Maximum video has been uploaded.",
                 [
                    'element' => 'error_message'
                 ]);
                 return $this->redirect($this->referer());
                }*/
            }

            else
            {
                if($conditionCheck == 0)
                {

                $this->request->data['status'] = 1;
                $media = $this->Medias->patchEntity($media, $this->request->getData());
                    if($this->Medias->save($media))
                    {
                        $mediaMetasTable = TableRegistry::get('media_metas');

                        $mediaMeta = $mediaMetasTable->newEntity();
                        $mediaMeta->media_id = $media->id;
                        $mediaMeta->description = $this->request->getData("description");
                       // $mediaMeta->tag = $this->request->getData("tag");
                        $mediaMeta->media_link = $this->request->getData("media_link");
                        $mediaMeta->title = $this->request->getData("title");
                        $mediaMeta->is_active = 1;
                        $mediaMetasTable->save($mediaMeta);

                        $this->Flash->set("Video saved",
                            [
                                'element' => 'success_message'
                            ]);
                        return $this->redirect($this->referer());
                    }
                }

            else
            {
                 $this->Flash->set("To upload more video's upgrade account to premium membership.",
                 [
                    'element' => 'error_message'
                 ]);
                 return $this->redirect($this->referer());
            }

            }

        }

        $this->set(compact('media', $media));
        $this->view = '/Element/hometopfiles/videoadd';
    }


//Add condition for Upload Audio

    public function addaudio()
    {
        $uid = $this->Auth->user('id');
        $media = $this->Medias->newEntity();

        $this->loadModel('Users');

        $userRole = $this->Users->get($uid, [
            'contain' => ['UserRoles']
         ]);

        $userRoleID = $userRole->user_roles[0]->role_id;

        if($this->request->is('post'))
        {
            $this->request->data['user_id'] = $uid;

             $conditionCheck = $this->Medias->find('list')->where(['user_id' => $uid,'type'=> 2])->count();

            if($userRoleID == 4)
            {

                /*if($conditionCheck < 5)
                {*/
                    $this->request->data['status'] = 1;
                    $media = $this->Medias->patchEntity($media, $this->request->getData());

                    if($this->Medias->save($media))
                    {

                    // audio upload
                    $data = $this->request->getData('audio');
                        if($data['tmp_name'] !=NULL){
                            $imgTmp=$data['tmp_name'];
                            $folder="files/audio/".$uid."/";
                            $dir = new Folder();
                            $dir->create(WWW_ROOT . "files/audio/".$uid."/");
                            if($imgTmp !='')
                            {
                                move_uploaded_file($imgTmp, $folder.$data['name']);
                            }
                        }
                    // audio upload end


                        $mediaMetasTable = TableRegistry::get('media_metas');

                        $mediaMeta = $mediaMetasTable->newEntity();
                        $mediaMeta->media_id = $media->id;
                        $mediaMeta->description = $this->request->getData("description");
                        $mediaMeta->tag = $this->request->getData("tag");
                        $mediaMeta->media_link = $folder.$data['name'];
                        //$mediaMeta->media_link = $this->request->getData("media_link");
                        $mediaMeta->title = $this->request->getData("title");
                        $mediaMeta->is_active = 1;
                        $mediaMetasTable->save($mediaMeta);

                         $this->Flash->set("Audio saved",
                            [
                                'element' => 'success_message'
                            ]);
                        return $this->redirect($this->referer());
                    }
                /*}

                else
                {
                     $this->Flash->set("Maximum audio has been uploaded.",
                     [
                        'element' => 'error_message'
                     ]);
                     return $this->redirect($this->referer());
                }*/

        }

        else
        {
            if($conditionCheck == 0)
            {
                $this->request->data['status'] = 1;
                $media = $this->Medias->patchEntity($media, $this->request->getData());
                if($this->Medias->save($media))
                {
                    // audio upload
                    $data = $this->request->getData('audio');
                        if($data['tmp_name'] !=NULL){
                            $imgTmp=$data['tmp_name'];
                            $folder="files/audio/".$uid."/";
                            $dir = new Folder();
                            $dir->create(WWW_ROOT . "files/audio/".$uid."/");
                            if($imgTmp !='')
                            {
                                move_uploaded_file($imgTmp, $folder.$data['name']);
                            }
                        }
                    // audio upload end

                    $mediaMetasTable = TableRegistry::get('media_metas');

                    $mediaMeta = $mediaMetasTable->newEntity();
                    $mediaMeta->media_id = $media->id;
                    $mediaMeta->description = $this->request->getData("description");
                    $mediaMeta->tag = $this->request->getData("tag");
                    $mediaMeta->media_link = $folder.$data['name'];
                    //$mediaMeta->media_link = $this->request->getData("media_link");
                    $mediaMeta->title = $this->request->getData("title");
                    $mediaMeta->is_active = 1;
                    $mediaMetasTable->save($mediaMeta);

                     $this->Flash->set("Audio saved",
                        [
                            'element' => 'success_message'
                        ]);
                    return $this->redirect($this->referer());
                }
            }

            else
            {
                 $this->Flash->set("To upload more audios's upgrade account to premium membership.",
                 [
                    'element' => 'error_message'
                 ]);
                 return $this->redirect($this->referer());
            }
        }
    }

        $this->set(compact('media', $media));
        $this->view = '/Element/hometopfiles/audioadd';
    }

    public function mediaList(){
       $medias = $this->Medias->find()
        ->contain(['MediaMetas','Users'])
        ->join([
            'table' => 'user_roles',
            'alias' => 'userroles',
            'type' => 'LEFT',
            'conditions' => [
                'userroles.user_id = Medias.user_id',
            ]
        ])
        ->where([
            '(type=1 or type=2)',
            'status' => 1,
            'userroles.role_id' => 4,
            'Users.is_featured' => 1,
        ])
        ->order([
            'Medias.created'=>'desc',
        ]);
        $this->set(compact('medias'));
    }
}
