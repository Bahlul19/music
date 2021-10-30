<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

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
        $this->paginate = [
            'contain' => ['Questions', 'Answers', 'Users']
        ];
        $polls = $this->paginate($this->Polls);

        $this->set(compact('polls'));
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
        $poll = $this->Polls->get($id, [
            'contain' => ['Questions', 'Answers', 'Users']
        ]);

        $this->set('poll', $poll);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
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

    /**
     * Edit method
     *
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
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

    /**
     * Delete method
     *
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
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

    /**
     * Question Answer method
     *
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function getQuestionAnswer()
    {
       $uid = $this->Auth->user('id');   
       $this->request->data['user_id'] = $uid;
        $poll = $this->Polls->newEntity();

        if ($this->request->is('post')) 
        {
            $poll = $this->Polls->patchEntity($poll, $this->request->getData());

            if ($this->Polls->save($poll)) 
            {
                $questions = $this->request->data['question_id'] ;
                $answers = $this->request->data['answer_id'];     

                return $this->redirect(['controller' => 'Questions', 'action' => 'pollSystem']);
            }
           else
            {
                 $this->Flash->set("Input Not Submitted",
                 [
                    'element' => 'error_message'
                 ]);       
            }
        }
        $questions = $this->Polls->Questions->find('list', ['limit' => 200]);
        $answers = $this->Polls->Answers->find('list', ['limit' => 200]);
        $users = $this->Polls->Users->find('list', ['limit' => 200]);
        $this->set(compact('poll', 'questions', 'answers', 'users'));

        return $this->redirect(['controller' => 'Polls', 'action' => 'dynamic_chart']);

    }
    /**
     * Dynamic Chart method
     *
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function dynamicChart($questions =null, $answers=null)
    {
        $totalNumberOfRow = $this->Polls->find('all')->count();  

        $this->loadModel('Answers');

        $AnswerTableID = $this->Answers->find('all')->where(['question_id' => $questions])->toArray();

         $condition = array();
        foreach($AnswerTableID as $question)
        {
          $conditionCheck = $this->Polls->find('all')->where(['question_id' =>  $questions, 'answer_id' =>$question['id']])->count();

          $conditionCheckFor = $this->Polls->find('all')->where(['question_id' =>  $questions, 'answer_id' =>$question['id']])->contain('Questions')->first();

          array_push($condition, $conditionCheck);
        }

        $datapoints = [];

        $i =0;

         $datapointsTitle = $conditionCheckFor->question->question;
        foreach ($condition as $key => $value) {

           $datapoints[$key]['label'] = $AnswerTableID[$i]->answer;
           $datapoints[$key]['y'] = $value;
           $datapoints[$key]['x'] = $key;
           $i++;
        }
        $datapoints = json_encode($datapoints);
         $this->set(compact('avgNumbers','condition','datapoints','datapointsTitle'));
    }

}
