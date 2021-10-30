<?php
namespace App\Controller\Admin;
use cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use App\Controller\Admin\AppController;

/**
 * Feedbacks Controller
 *
 * @property \App\Model\Table\FeedbacksTable $Feedbacks
 *
 * @method \App\Model\Entity\Feedback[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeedbacksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin");
 
        if(in_array($role,$userAccess))
        {
            // $this->paginate = [
            //     'contain' => ['Users']
            // ];
            //$feedbacks = $this->paginate($this->Feedbacks);
            $feedbacks=$this->Feedbacks->find('all')->order(['id' => 'DESC'])->toArray();;
            $this->set(compact('feedbacks',$feedbacks));
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
     * @param string|null $id Feedback id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin");
 
        if(in_array($role,$userAccess))
        {
            // $feedback = $this->Feedbacks->get($id, [
            //     'contain' => ['Users']
            // ]);
            $feedback = $this->Feedbacks->get($id);
            if($feedback['status']==0){
            $feedback['status']=1;}
            $this->Feedbacks->save($feedback);
            $this->set('feedback', $feedback);
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

        $userAccess = array("superadmin","admin");
 
        if(in_array($role,$userAccess))
        {
            $feedback = $this->Feedbacks->newEntity();
            if ($this->request->is('post')) {
                $feedback = $this->Feedbacks->patchEntity($feedback, $this->request->getData());
                if ($this->Feedbacks->save($feedback)) {
                    $this->Flash->success(__('The feedback has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The feedback could not be saved. Please, try again.'));
            }
            $users = $this->Feedbacks->Users->find('list', ['limit' => 200]);
            $this->set(compact('feedback', 'users'));
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
     * @param string|null $id Feedback id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin");
 
        if(in_array($role,$userAccess))
        {
            $feedback = $this->Feedbacks->get($id, [
                'contain' => []
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $feedback = $this->Feedbacks->patchEntity($feedback, $this->request->getData());
                if ($this->Feedbacks->save($feedback)) {
                    $this->Flash->success(__('The feedback has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The feedback could not be saved. Please, try again.'));
            }
            $users = $this->Feedbacks->Users->find('list', ['limit' => 200]);
            $this->set(compact('feedback', 'users'));
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
     * @param string|null $id Feedback id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin");
 
        if(in_array($role,$userAccess))
        {
            $this->request->allowMethod(['post', 'delete']);
            $feedback = $this->Feedbacks->get($id);
            if ($this->Feedbacks->delete($feedback)) {
                $this->Flash->success(__('The feedback has been deleted.'));
            } else {
                $this->Flash->error(__('The feedback could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
    }

    public function feedbackreply(){
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin");
 
        if(in_array($role,$userAccess))
        {
            if($this->request->is('post')) 
            {
                $sender = $this->request->data['sender_email'];
                $recepient = $this->request->data['fbRecepient'];
                $subject= $this->request->data['subject'];
                $content = $this->request->data['content'];
                
                $Email = new Email('default');
                $Email->config('smtp');
                $Email->from($sender)
                    ->to($recepient)
                    ->subject($subject)
                    ->template('default')
                    ->emailFormat('html')
                    ->viewVars(array('content' => $content));
                if($Email->send()) 
                {
                    $this->Flash->success('Email has been sent to user.');
                    $feedback = $this->Feedbacks->get($this->request->data['fbid']);
                    $feedback['status']=2;
                    $this->Feedbacks->save($feedback);
                }
                else {
                    $this->Flash->error('Email not sent. Please try again.');
                }
                $this->redirect($this->referer());
            }
        }
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }        
    }
}
