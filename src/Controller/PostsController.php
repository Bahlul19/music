<?php
namespace App\Controller;

use App\Controller\AppController;

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
        
        $this->paginate = [
            'contain' => ['Medias', 'PostCategorys', 'PostTags']
        ];
        
        $posts = $this->paginate($this->Posts);
       

        $this->set(compact('posts'));
    }

    /*New page method for create the custom template*/

    public function page()
    {
        $posts = $this->Posts->find('all',[
            'contain' => ['Medias']
        ])->where(['Posts.status' => 1])->toArray();

        $this->set(compact('posts'));
    }

    public function newsslider(){

       // $news = $this->Posts->find('all')->contain(['Medias', 'PostCategorys', 'PostTags'])->where(['content_type' => 1])->order(['posts.created' => 'DESC'])->toArray();

        $news = $this->Posts->find('all', [
            'contain' => ['Medias', 'PostCategorys', 'PostTags'],
            'conditions' => [
            'Posts.status' => 1,
            'content_type' => 1
            ],
            'order' => ['Posts.created' => 'DESC']
            ])->toArray();
        // dd($news)

       $this->set(compact('news'));

    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Medias', 'PostCategorys', 'PostTags']
        ]);
        $this->set('post', $post);
    }

    /**
     * Posts Details method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function postdetails($slug=null)
    {
       $post = $this->Posts->find('all', [
            'contain' => 
            [
                'Medias'
            ],
            'conditions' =>
            [
                'Posts.status' => 1
            ]
        ])->where(['slug' => $slug])->first();

        $this->loadModel('Comments');
        $getQuery = $this->Comments->find('all')->contain(['Users'])->where(['post_id' => $post['id']])->toArray();
         $this->set('post', $post);
         $this->set('getQuery', $getQuery);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $media = $this->Posts->Medias->find('list', ['limit' => 200]);
        $postCategories = $this->Posts->PostCategorys->find('list', ['limit' => 200]);
        $postTags = $this->Posts->PostTags->find('list', ['limit' => 200]);
        $this->set(compact('post', 'media', 'postCategories', 'postTags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $media = $this->Posts->Media->find('list', ['limit' => 200]);
        $postCategories = $this->Posts->PostCategories->find('list', ['limit' => 200]);
        $postTags = $this->Posts->PostTags->find('list', ['limit' => 200]);
        $this->set(compact('post', 'media', 'postCategories', 'postTags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

     /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

}
