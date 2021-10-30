<?php
namespace App\Controller;
use cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use App\Controller\AppController;

/**
 * Feedbacks Controller
 *
 * @property \App\Model\Table\FeedbacksTable $Feedbacks
 *
 * @method \App\Model\Entity\Feedback[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeedbacksController extends AppController
{
     public $paginate = [
        'limit' => 10
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
    
    public function contact()
    {
        $feedback = $this->Feedbacks->newEntity();
        if ($this->request->is('post')) {
            //get verify response data
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.SECRET.'&response='.$_POST['recaptcha']);
            $responseData = json_decode($verifyResponse);
            if($responseData->success) { 
            $feedback->name=$this->request->getData()['fbname'];
            $feedback->email=$this->request->getData()['fbemail'];
            $feedback->comment=$this->request->getData()['comment'];
            $query=TableRegistry::getTableLocator()->get('users')->find()->select(['id'],['email'])->where(['email' => $feedback->email]);
                foreach ($query as $email) {
                    if(!empty($email)){
                    $feedback->user_id=$email->id;
                    }
                }
            if ($this->Feedbacks->save($feedback)) {
                $this->Flash->success(__('The feedback has been saved.'));
                
                $sender = sender_email;
                $recepient = $this->request->getData()['fbemail'];
                $subject= "ITH feedback";
                $content = "Your feedback was recorded.";
                
                $Email = new Email('default');
                $Email->config('smtp');
                $Email->from($sender)
                    ->to($recepient)
                    ->subject($subject)
                    ->template('default')
                    ->emailFormat('html')
                    ->viewVars(array('content' => $content));
                $Email->send();

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The feedback could not be saved. Please, try again.'));
            }
            else {
                $this->Flash->error(__('Recaptcha verification failed. Please, try again.'));
            }
        }
        //$users = $this->Feedbacks->Users->find('list', ['limit' => 5]);
        $this->set(compact('feedback'));    
    }   
}
