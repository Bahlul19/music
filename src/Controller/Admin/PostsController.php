<?php
namespace App\Controller\Admin;

use Cake\Utility\Text;
use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff","Content manager");
 
        if(in_array($role,$userAccess))
        {
            $posts=$this->Posts->find('all',[
                'contain' => ['Medias']
            ])->toArray();
            $this->set(compact('posts'));
        }
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
    }

    private function __filter($data = null)
    {
        if (count($this->request->query) > 0) {
            //Get column names from table
            $columns = $this->Posts->schema()->columns();
            $filter = array();
            //Checking to see if the params are columns
            foreach ($data as $key => $value) {
                if (in_array($key, $columns)) {
                    $filter[$key . ' ='] = "$value";
                }
            }
            //If params were set and met the criteria, run conditions
            return $this->paginate($this->Posts, [
                'limit' => 15,
                'conditions' => [$filter]
            ]);
        }
        //There was no filter set, see all
        return $this->paginate($this->Posts, [
            'limit' => 15,
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff","Content manager");
 
        if(in_array($role,$userAccess))
        {
            $post = $this->Posts->findBySlug($slug)->firstOrFail();
            $id = $post->id;
            $post = $this->Posts->get($id, [
                'contain' => ['Medias']
            ]);
            $this->set('post', $post);
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

        $userAccess = array("superadmin","admin","ITH Staff","Content manager");
 
        if(in_array($role,$userAccess))
        {
            $post = $this->Posts->newEntity();
            $mediaTable = TableRegistry::getTableLocator()->get('Medias');
            if ($this->request->is('post')) {
                $image = $this->request->getData('image');
                $imageError = false;
                if(!empty($image['name']))
                {
                    $type = explode('/', $image['type']);
                    if($type[0] == 'image')
                    {
                        $imageEntity = $mediaTable->newEntity();
                        $fileName = $image['name'];
                        $imageEntity->name = $fileName;
                        $session = $this->request->session();
                        $user_id = $session->read('Auth.User.id');
                        $imageEntity->user_id = $user_id;
                        $imageEntity->type = 1;
                        $imageEntity->status = 1;
                        $uploadPath = WWW_ROOT .'/files/images/featuredPostImages/';
                        $dir = new Folder();
                        $dir->create(WWW_ROOT . 'files/images/featuredPostImages/');
                        $uploadFile = $uploadPath.$fileName;
                        $mediaTable->save($imageEntity);
                        $post->media_id = $imageEntity->id;
                        move_uploaded_file($image['tmp_name'], $uploadFile);
                    } else {
                        $imageError = true;
                        $this->Flash->error(__('upload image only of size less than 2MB'));
                    }
                }
                if(empty($image['name']) || $imageError == false)
                {
                    $post = $this->Posts->patchEntity($post, $this->request->getData());
                    $post->slug = strtolower(Text::slug($post->title, '-'));
                    $number = 1;
                    while($number != 0) {
                        $query = $this->Posts->find('all', [
                        'conditions' => ['Posts.slug LIKE' => $post->slug]
                        ]);
                        $number = $query->count();
                        if($number > 0) {
                            $post->slug = $post->slug.'-'.$number;
                        } else {
                            break;
                        }
                    }
                    if ($this->Posts->save($post)) {
                        $this->Flash->success(__('The post has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The post could not be saved. Please, try again.'));
                }

                
            }
            $media = $this->Posts->Medias->find('list', ['limit' => 200]);
            $postCategories = $this->Posts->PostCategorys->find('list', ['limit' => 200]);
            $postTags = $this->Posts->PostTags->find('list', ['limit' => 200]);
            $this->set(compact('post', 'media', 'postCategories', 'postTags'));
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
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff","Content manager");
 
        if(in_array($role,$userAccess))
        {
            $post = $this->Posts->findBySlug($slug)->firstOrFail();
            $id = $post->id;
            $post = $this->Posts->get($id, [
                'contain' => ['Medias']
            ]);
            $mediaTable = TableRegistry::getTableLocator()->get('Medias');
            if ($this->request->is(['patch', 'post', 'put'])) {

                $image = $this->request->getData('image');
                $imageError = false;
                if(!empty($image['name']))
                {
                    $type = explode('/', $image['type']);
                    if($type[0] == 'image')
                    {
                        $imageEntity = $mediaTable->newEntity();
                        $fileName = $image['name'];
                        $imageEntity->name = $fileName;
                        $session = $this->request->session();
                        $user_id = $session->read('Auth.User.id');
                        $imageEntity->user_id = $user_id;
                        $imageEntity->type = 1;
                        $imageEntity->status = 1;
                        $uploadPath = WWW_ROOT .'/files/images/featuredPostImages/';
                        $uploadFile = $uploadPath.$fileName;
                        $mediaTable->save($imageEntity);
                        $post->media_id = $imageEntity->id;
                        move_uploaded_file($image['tmp_name'], $uploadFile);
                    } else {
                        $this->Flash->error(__('upload image only of size less than 2MB'));
                        $imageError = true;
                    }
                } 
                if(empty($image['tmp_name']) || $imageError == false)
                {
                    $post = $this->Posts->patchEntity($post, $this->request->getData());
                    $post->slug = strtolower(Text::slug($post->slug, '-'));
                    $number = 1;
                    while($number != 0) {
                        $query = $this->Posts->find('all', [
                        'conditions' => ['Posts.slug LIKE' => $post->slug]
                        ]);
                        $number = $query->count();
                        if($number > 0) {
                            $post->slug = $post->slug.'-'.$number;
                        } else {
                            break;
                        }
                    }
                    
                    if ($this->Posts->save($post)) {
                        $this->Flash->success(__('The post has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The post could not be saved. Please, try again.'));
                }

            }
            $media = $this->Posts->Medias->find('list', ['limit' => 200]);
            $postCategories = $this->Posts->PostCategorys->find('list', ['limit' => 200]);
            $postTags = $this->Posts->PostTags->find('list', ['limit' => 200]);
            $this->set(compact('post', 'media', 'postCategories', 'postTags'));
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
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($slug = null)
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin","ITH Staff","Content manager");
 
        if(in_array($role,$userAccess))
        {
            $post = $this->Posts->findBySlug($slug)->firstOrFail();
            $id = $post->id;
            $this->request->allowMethod(['post', 'delete']);
            $post = $this->Posts->get($id);
            if ($this->Posts->delete($post)) {
                $this->Flash->success(__('The post has been deleted.'));
            } else {
                $this->Flash->error(__('The post could not be deleted. Please, try again.'));
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
