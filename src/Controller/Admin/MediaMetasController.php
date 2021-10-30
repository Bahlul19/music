<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * MediaMetas Controller
 *
 * @property \App\Model\Table\MediaMetasTable $MediaMetas
 *
 * @method \App\Model\Entity\MediaMeta[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MediaMetasController extends AppController
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
                //$this->loadModel('Users');
                $mediaMetas = $this->MediaMetas->find('all',[
                    'contain' => [
                        'Medias' =>
                        ['Users']
                    ],
                    'order' => ['MediaMetas.id' => 'desc']
                ])->toArray();

                //dd($mediaMetas);

            $this->set(compact('mediaMetas'));
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
     * @param string|null $id Media Meta id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff");
 
        if(in_array($role,$userAccess))
        {
            $mediaMeta = $this->MediaMetas->get($id, [
                'contain' => ['Medias', 'CartItems']
            ]);

            $this->set('mediaMeta', $mediaMeta);
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
            $mediaMeta = $this->MediaMetas->newEntity();
            if ($this->request->is('post')) {
                $mediaMeta = $this->MediaMetas->patchEntity($mediaMeta, $this->request->getData());
                if ($this->MediaMetas->save($mediaMeta)) {
                    $this->Flash->success(__('The media meta has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The media meta could not be saved. Please, try again.'));
            }
            $media = $this->MediaMetas->Medias->find('list', ['limit' => 200]);
            $this->set(compact('mediaMeta', 'media'));
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
     * @param string|null $id Media Meta id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff");
 
        if(in_array($role,$userAccess))
        {
            $mediaMeta = $this->MediaMetas->get($id, [
                'contain' => ['Medias']
            ]);
    
            $this->loadModel('Medias');
    
            if ($this->request->is(['patch', 'post', 'put'])) {
    
                $mediasTableUpdate = $this->Medias->newEntity();
    
                $mediasTableID = $this->Medias->get($mediaMeta->media_id);
    
                //$mediasTableID = $this->request->data['media_id'];
    
                $mediasTableStatus = 1;
    
                $mediasTableUpdate =  $this->Medias->updateAll(array('status'=>$mediasTableStatus), array('id'=>$mediasTableID->id));
                $mediaMeta = $this->MediaMetas->patchEntity($mediaMeta, $this->request->getData());
                if ($this->MediaMetas->save($mediaMeta)) {
                    $this->Flash->success(__('The media meta has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                else{
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The media meta could not be saved. Please, try again.'));
            }
            $media = $this->MediaMetas->Medias->find('list', ['limit' => 200]);
            $this->set(compact('mediaMeta', 'media'));
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
     * @param string|null $id Media Meta id.
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
            $mediaMeta = $this->MediaMetas->get($id);
            $media = $mediaMeta->media_id;
            //debug($mediaMeta);exit;
            $mediatable=$this->loadModel('Medias');
            $media_entity = $mediatable->get($media);
            if ($this->MediaMetas->delete($mediaMeta)) {
                $this->Medias->delete($media_entity);
                $this->Flash->success(__('The media meta has been deleted.'));
            } else {
                $this->Flash->error(__('The media meta could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
    }
}
