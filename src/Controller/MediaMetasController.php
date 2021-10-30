<?php
namespace App\Controller;

use App\Controller\AppController;

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
        
        $this->paginate = [
            'contain' => []
        ];
        $mediaMetas = $this->paginate($this->MediaMetas);

        $this->set(compact('mediaMetas'));
        

        /*$mediaMetas = $this->MediaMetas->find('all',['contain' => 'Medias', 'order' => ['id' => 'DESC']])->toArray();
        $this->set(compact('mediaMetas',$mediaMetas));*/
        
        // $mediaMetas = $this->MediaMetas->find('all')->->order(['id' => 'DESC'])->toArray();;
        // $this->set(compact('mediaMetas',$mediaMetas));
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
        $mediaMeta = $this->MediaMetas->get($id, [
            'contain' => ['Medias', 'CartItems']
        ]);

        $this->set('mediaMeta', $mediaMeta);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response| null Redirects on successful add, renders view otherwise.
     */
    public function add()
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
        $media = $this->MediaMetas->Media->find('list', ['limit' => 200]);
        $this->set(compact('mediaMeta', 'media'));
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
        $mediaMeta = $this->MediaMetas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mediaMeta = $this->MediaMetas->patchEntity($mediaMeta, $this->request->getData());
            if ($this->MediaMetas->save($mediaMeta)) {
                $this->Flash->success(__('The media meta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media meta could not be saved. Please, try again.'));
        }
        $media = $this->MediaMetas->Media->find('list', ['limit' => 200]);
        $this->set(compact('mediaMeta', 'media'));
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

        return $this->redirect($this->referer());
    }
}
