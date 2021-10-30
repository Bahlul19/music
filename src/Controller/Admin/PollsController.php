<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Polls Controller
 *
 * @property \App\Model\Table\PollsTable $Polls
 *
 * @method \App\Model\Entity\Poll[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PollsController extends AppController
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
            $this->paginate = [
                'contain' => ['Questions', 'Answers', 'Users']
            ];
            $polls = $this->paginate($this->Polls);

            $this->set(compact('polls'));
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
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin");
 
        if(in_array($role,$userAccess))
        {
            $poll = $this->Polls->get($id, [
                'contain' => ['Questions', 'Answers', 'Users']
            ]);

            $this->set('poll', $poll);
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
            $poll = $this->Polls->newEntity();
            if ($this->request->is('post')) {
                $poll = $this->Polls->patchEntity($poll, $this->request->getData());
                if ($this->Polls->save($poll)) {
                    $this->Flash->success(__('The poll has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The poll could not be saved. Please, try again.'));
            }
            $questions = $this->Polls->Questions->find('list', ['limit' => 200]);
            $answers = $this->Polls->Answers->find('list', ['limit' => 200]);
            $users = $this->Polls->Users->find('list', ['limit' => 200]);
            $this->set(compact('poll', 'questions', 'answers', 'users'));
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
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin","admin");
 
        if(in_array($role,$userAccess))
        {
            $poll = $this->Polls->get($id, [
                'contain' => []
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $poll = $this->Polls->patchEntity($poll, $this->request->getData());
                if ($this->Polls->save($poll)) {
                    $this->Flash->success(__('The poll has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The poll could not be saved. Please, try again.'));
            }
            $questions = $this->Polls->Questions->find('list', ['limit' => 200]);
            $answers = $this->Polls->Answers->find('list', ['limit' => 200]);
            $users = $this->Polls->Users->find('list', ['limit' => 200]);
            $this->set(compact('poll', 'questions', 'answers', 'users'));
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
     * @param string|null $id Poll id.
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
            $poll = $this->Polls->get($id);
            if ($this->Polls->delete($poll)) {
                $this->Flash->success(__('The poll has been deleted.'));
            } else {
                $this->Flash->error(__('The poll could not be deleted. Please, try again.'));
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
     * Question Answer Dynamic Method
     *
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function dynamicChart($question_id = null)
    {
        $totalNumberOfRow = $this->Polls->find('all')->count(); 

        $this->loadModel('Answers');

        $AnswerTableID = $this->Answers->find('all')->where(['question_id' => $question_id])->toArray();

       $condition = array();

        foreach($AnswerTableID as $question)
        {
            // dd($question->question);
        $conditionCheck = $this->Polls->find('all')->where(['question_id' =>  $question_id, 'answer_id' =>$question['id']])->count();
        //dd($conditionCheck);

         $conditionCheckFor = $this->Polls->find('all')->where(['question_id' =>  $question_id, 'answer_id' =>$question['id']])->contain('Questions')->first();
         // ($conditionCheckFor);
         // $datapointsTitle = $conditionCheckFor->question->question;

         //dd($datapointsTitle);

         array_push( $condition, $conditionCheck);
        }

         $datapoints = [];
         //dd($datapoints);

         //dd($conditionCheck);

        // $datapointsTitle = $conditionCheckFor->question->question;
         //dd($datapointsTitle);

         $i =0;
         
         //dd($datapointsTitle);
        foreach ($condition as $key => $value) {

           $datapoints[$key]['label'] = $AnswerTableID[$i]->answer;
           $datapoints[$key]['y'] = $value;
           $datapoints[$key]['x'] = $key;
           $i++;
        }
        $datapoints = json_encode($datapoints);
        $this->loadModel('Questions');
        $questionName = $this->Questions->get($question_id);
        // dd($questionName);
         $this->set(compact('avgNumbers','condition','datapoints','datapointsTitle','questionName'));
    }
}
