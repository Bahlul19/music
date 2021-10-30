<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
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
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff");
 
        if(in_array($role,$userAccess))
        {
            $this->paginate = [
                'contain' => ['Users']
            ];
            $medias = $this->paginate($this->Medias);

            $this->set(compact('medias'));
        }
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
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
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff");
 
        if(in_array($role,$userAccess))
        {
            $media = $this->Medias->get($id, [
                'contain' => ['Users', 'Comments', 'Likes', 'MediaMetas', 'Posts', 'Profiles']
            ]);

            $this->set('media', $media);
        }
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff");
 
        if(in_array($role,$userAccess))
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
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
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
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff");
 
        if(in_array($role,$userAccess))
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
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
    }

    public function saveProfileImage($id = null)
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff");
 
        if(in_array($role,$userAccess))
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
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
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
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff");
 
        if(in_array($role,$userAccess))
        {
            $this->request->allowMethod(['post', 'delete']);
            $media = $this->Medias->get($id);
            if ($this->Medias->delete($media)) {
                $this->Flash->success(__('The media has been deleted.'));
            } else {
                $this->Flash->error(__('The media could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
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
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff");
 
        if(in_array($role,$userAccess))
        {
            $media = $this->Medias->newEntity();

            if($this->request->is('post'))
            {
                $uid = $this->Auth->user('id');
                $this->request->data['user_id'] = $uid;
                /*for working with video upload*/
                //$this->request->data['type'] = 1;

                $conditionCheck = $this->Medias->find('list')->where(['user_id' => $uid, 'type' => 1])->count();
                if($conditionCheck == 0)
                {

                $this->request->data['status'] = 0;
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
                    $mediaMetasTable->save($mediaMeta);

                    $this->Flash->set("Thanks for the Uploading",
                        [
                            'element' => 'success_message'
                        ]);
                }
                }

                else
                {
                    $this->Flash->set("Please upgrade your subscription for pro membership",
                    [
                        'element' => 'error_message'
                    ]);
                }
            }

            $this->set(compact('media', $media));
        }
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
    }

    public function addaudio()
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff");
 
        if(in_array($role,$userAccess))
        {
            $media = $this->Medias->newEntity();

            if($this->request->is('post'))
            {
                $uid = $this->Auth->user('id');

                $this->request->data['user_id'] = $uid;

                $conditionCheck = $this->Medias->find('list')->where(['user_id' => $uid,'type'=> 2])->count();

                if($conditionCheck == 0)
                {
                $this->request->data['status'] = 0;
                $media = $this->Medias->patchEntity($media, $this->request->getData());
                if($this->Medias->save($media))
                {
                    $mediaMetasTable = TableRegistry::get('media_metas');

                    $mediaMeta = $mediaMetasTable->newEntity();
                    $mediaMeta->media_id = $media->id;
                    $mediaMeta->description = $this->request->getData("description");
                    $mediaMeta->tag = $this->request->getData("tag");
                    $mediaMeta->media_link = $this->request->getData("media_link");
                    $mediaMeta->title = $this->request->getData("title");
                    $mediaMetasTable->save($mediaMeta);

                    $this->Flash->set("Thanks for the Uploading",
                        [
                            'element' => 'success_message'
                        ]);
                }
            }

                else
                {
                    $this->Flash->set("Please upgrade your subscription for pro membership",
                    [
                        'element' => 'error_message'
                    ]);
                }
            }

            $this->set(compact('media', $media));
        }
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
    }
}
